import struct

class ParameterParser:
    def __init__(self, lookups):
        self.result = {}
        self._lookups = lookups 
        return

    def parse (self, rawData, start, length):
        for i in self._lookups['parameters']:
            for j in i['items']:
                self.try_parse_field(rawData, j, start, length)        
        return

    def get_result(self):
        return self.result


    def try_parse_field (self, rawData, definition, start, length):
        rule = definition['rule']
        if rule == 1:
            self.try_parse_unsigned(rawData,definition, start, length)
        elif rule == 2:
            self.try_parse_signed(rawData,definition, start, length)
        elif rule == 3:
            self.try_parse_unsigned(rawData,definition, start, length)
        elif rule == 4:
            self.try_parse_signed(rawData,definition, start, length)
        elif rule == 5:
            self.try_parse_ascii(rawData,definition, start, length)
        elif rule == 6:
            self.try_parse_bits(rawData,definition, start, length)
        elif rule == 7:
            self.try_parse_version(rawData,definition, start, length)
        elif rule == 8:
            self.try_parse_datetime(rawData,definition, start, length)
        elif rule == 9:
            self.try_parse_time(rawData,definition, start, length)
        elif rule == 10:
            self.try_parse_time_sofar(rawData,definition, start, length)
        elif rule == 11:
            self.try_parse_date_sofar(rawData,definition, start, length)
        elif rule == 12:
            self.try_parse_bin_sofar(rawData,definition, start, length)
        elif rule == 13:
            self.try_parse_bin(rawData,definition, start, length)
        return
    
    def do_validate(self, title, value, rule):
        if 'min' in rule:           
            if rule['min'] > value:
                if 'invalidate_all' in rule:
                    raise ValueError(f'Invalidate complete dataset ({title} ~ {value})')
                return False

        if 'max' in rule:                       
            if rule['max'] < value:
                if 'invalidate_all' in rule:
                    raise ValueError(f'Invalidate complete dataset ({title} ~ {value})')
                return False
        
        return True

    def try_parse_signed (self, rawData, definition, start, length):
        title = definition['name']
        registers = hex(definition['registers'][0])
        scale = definition['scale']
        value = 0
        found = True
        shift = 0
        maxint = 0
        for r in definition['registers']:
            index = r - start   # get the decimal value of the register'
            if (index >= 0) and (index < length):
                maxint <<= 16
                maxint |= 0xFFFF
                temp = rawData[index]
                value += (temp & 0xFFFF) << shift
                shift += 16
            else:
                found = False
        if found:
            if 'offset' in definition:
                value = value - definition['offset']       
                      
            if value > maxint/2:
                value = (value - maxint) * scale
            else:
                value = value * scale
                
            if 'validation' in definition:
                if not self.do_validate(title, value, definition['validation']):
                    return
                
            if self.is_integer_num (value):
                self.result[registers] = int(value)  
            else:   
                self.result[registers] = value

        return
    
    def try_parse_unsigned (self, rawData, definition, start, length):
        title = definition['name']
        scale = definition['scale']
        registers = hex(definition['registers'][0])
        value = 0
        found = True
        shift = 0
        for r in definition['registers']:
            index = r - start   # get the decimal value of the register'
            if (index >= 0) and (index < length):
                temp = rawData[index]
                value += (temp & 0xFFFF) << shift
                shift += 16
            else:
                found = False
        if found:
            if 'mask' in definition:
                mask = definition['mask']
                value &= mask

            if 'lookup' in definition:
                self.result[registers] = self.lookup_value (value, definition['lookup'])
            else:
                if 'offset' in definition:
                    value = value - definition['offset']  
                                   
                value = value * scale
                
                if 'validation' in definition:
                    if not self.do_validate(title, value, definition['validation']):
                        return

                if self.is_integer_num (value):
                    self.result[registers] = int(value)  
                else:   
                    self.result[registers] = value   
        return


    def lookup_value (self, value, options):
        for o in options:
            if (o['key'] == value):
                return o['value']
        return value


    def try_parse_ascii (self, rawData, definition, start, length):
        title = definition['name']
        registers = hex(definition['registers'][0])
        found = True
        value = ''
        for r in definition['registers']:
            index = r - start   # get the decimal value of the register'
            if (index >= 0) and (index < length):
                temp = rawData[index]
                value = value + chr(temp >> 8) + chr(temp & 0xFF)
            else:
                found = False

        if found:
            self.result[registers] = value
        return  
    
    def try_parse_bits (self, rawData, definition, start, length):
        title = definition['name'] 
        registers = hex(definition['registers'][0])     
        found = True
        value = 0
        for r in definition['registers']:
            index = r - start   # get the decimal value of the register'
            if (index >= 0) and (index < length):
                temp = rawData[index]
                value = value * 65536 + temp
            else:
                found = False

        if found:
            self.result[registers] = hex(value)
        return 
    
    def try_parse_version (self, rawData, definition, start, length):
        title = definition['name']         
        registers = hex(definition['registers'][0])
        found = True
        value = ''
        for r in definition['registers']:
            index = r - start   # get the decimal value of the register'
            if (index >= 0) and (index < length):
                temp = rawData[index]
                value = value + str(temp >> 12) + "." +  str(temp >> 8 & 0x0F) + "." + str(temp >> 4 & 0x0F) + "." + str(temp & 0x0F)
            else:
                found = False
 
        if found:
            self.result[registers] = value
        return

    def try_parse_datetime (self, rawData, definition, start, length):
        title = definition['name']         
        registers = hex(definition['registers'][0])
        found = True
        value = ''
        print("start: ", start)
        for i,r in enumerate(definition['registers']):
            index = r - start   # get the decimal value of the register'
            print ("index: ",index)
            if (index >= 0) and (index < length):
                temp = rawData[index]
                if(i==0):
                    value = value + str(temp >> 8)  + "/" + str(temp & 0xFF) + "/"
                elif (i==1):
                    value = value + str(temp >> 8)  + " " + str(temp & 0xFF) + ":"
                elif(i==2):
                    value = value + str(temp >> 8)  + ":" + str(temp & 0xFF)
                else:
                    value = value + str(temp >> 8)  + str(temp & 0xFF)
            else:
                found = False
 
        if found:
            self.result[registers] = value
        return

    def try_parse_time (self, rawData, definition, start, length):
        title = definition['name']         
        registers = hex(definition['registers'][0])
        found = True
        value = ''
        for r in definition['registers']:
            index = r - start   # get the decimal value of the register'
            if (index >= 0) and (index < length):
                temp = rawData[index]
                value = str("{:02d}".format(int(temp / 100))) + ":" + str("{:02d}".format(int(temp % 100)))
            else:
                found = False

        if found:
            self.result[registers] = value
        return

    def try_parse_time_sofar (self, rawData, definition, start, length):
        title = definition['name']         
        found = True
        registers = hex(definition['registers'][0])
        temp = ''
        for r in definition['registers']:
            index = r - start   # get the decimal value of the register'
            if (index >= 0) and (index < length):
                temp += str(rawData[index])
            else:
                found = False
        value = ''
        heure = int(int(temp) / 256)
        minute = int(temp) - (heure * 256)
        value = str("{:02d}".format(heure)) + ":" + str("{:02d}".format(minute))
        if found:
            self.result[registers] = value
        return

    def try_parse_date_sofar (self, rawData, definition, start, length):
        title = definition['name']         
        found = True
        registers = hex(definition['registers'][0])
        temp = ''
        for r in definition['registers']:
            index = r - start
            if (index >= 0) and (index < length):
                temp += str(rawData[index])
            else:
                found = False
        value = ''
        mois = int(int(temp) / 256)
        jour = int(temp) - (mois * 256)
        value = str("{:02d}".format(jour)) + "/" + str("{:02d}".format(mois))
        if found:
            self.result[registers] = value
        return

    def try_parse_bin_sofar (self, rawData, definition, start, length):
        title = definition['name'] 
        registers = hex(definition['registers'][0])     
        found = True
        value = 0
        for r in definition['registers']:
            index = r - start
            if (index >= 0) and (index < length):
                temp = rawData[index]
                value = value * 65536 + temp
            else:
                found = False

        if found:
            self.result[registers] = format(value, '07b')
        return 
    

    def try_parse_bin (self, rawData, definition, start, length):
        title = definition['name'] 
        registers = hex(definition['registers'][0])     
        found = True
        value = 0
        valuestr = ''
        for r in definition['registers']:
            index = r - start
            if (index >= 0) and (index < length):
                temp = rawData[index]
                value = value * 65536 + temp
                valuestr += format(temp, '016b')
            else:
                found = False

        if found:
            self.result[registers] = valuestr
        return 
    
    def get_sensors (self):
        result = []
        for i in self._lookups['parameters']:
            for j in i['items']:
                result.append(j)
        return result
    
    def is_integer_num(self, n):
        if isinstance(n, int):
            return True
        if isinstance(n, float):
            return n.is_integer()
        return False