# Changelog plugin Solarman


>**WICHTIG**
>
>Wenn keine Informationen zum Update vorhanden sind, handelt es sich lediglich um eine Aktualisierung der Dokumentation, der Übersetzung oder des Textes.

Wenn Sie mir über PayPal einen Kaffee spendieren möchten: [Einen Kaffee spendieren](https://www.paypal.com/donate/?hosted_button_id=JD64LAEUMUWMU)


# 1.2.6

   - Die Übernahme bestimmter Teile der Vorlage sollte normalerweise keine Auswirkungen haben
   - Möglichkeit, die Parameter der Vorlage zusätzlich zur derzeitigen Methode in der Gerätekonfiguration einzugeben
   
# 1.2.4

   - Möglichkeit, einen Registerbereich zu scannen, um zu überprüfen, ob dieser zugänglich ist, und die Konformität der erfassten Daten zu gewährleisten
   - Hinzufügen von Modbus-Dateien für einige Wechselrichter

# 1.2.3

   - Hinzufügen der Versionsnummer zusätzlich zum Datum im Feld „Status“ der Plugin-Konfiguration (Vielen Dank an @Bad für die Hilfe)
   - Verbesserung des Abfrageprozesses des Wechselrichters. Das Plugin stellt nun eine Verbindung her und trennt diese erst, wenn alle Register abgefragt wurden (früher erfolgte bei jedem Registerbereich eine Trennung und erneute Verbindung – meine Schuld).
   - Korrektur einiger Tippfehler

# 1.2.2

   - Berücksichtigung der S2-WL-ST-Schlüssel, die an bestimmten SOLIS-Wechselrichtern installiert sind (möglicherweise auch an anderen?)

# 1.2.1 (09.12.2024) => Beta

   - Verwendung der Bibliotheken von @nebz und @Mips + @TiTidom-RC (dependance.lib und pyenv.lib)

# 1.1.1b (05.09.2024) => Beta + stabil

   - Ein etwas „sauberer“ Patch als der, der kurzfristig für Version 1.1.1 bereitgestellt wurde

# 1.1.1 (02.09.2024) => Beta + stabil

   - Behebung eines Fehlers, der zu einer Speicherüberlastung führte

# 1.1.0 (28.08.2024) => Beta + stabil

   - Einrichtung einer virtuellen Umgebung für Python
   - Hinzufügen und/oder Ändern der YAML-Konfigurationsdateien von Wechselrichtern

# 1.0.9 (13.07.2024) => Beta + stabil

   - Behebung eines Fehlers beim Erstellen bestimmter Ausrüstungsgegenstände
   - Einrichtung einer Schaltfläche zum direkten Posten in der Community

# 1.0.8 (30.03.2024) => Beta + stabil

   - Hinzufügen von für Sofar Solar spezifischen Dekodierungsregeln (Uhrzeit und Datum), siehe Regel 10 und 11 in der Dokumentation
   - Hinzufügen einer Dekodierungsregel mit Ausgabe im Binärformat
   - Hinzufügen und/oder Ändern von Konfigurationsdateien
   - Möglichkeit, dem Widget Befehle vom Gerät aus zuzuweisen
   - Umbenennung des Widgets in „solarman_distri_onduleur“ – sorry @phpvarious, dass ich nicht daran gedacht habe

# 1.0.7 (08.12.2023) => Beta + stabil

   - Datei zum Wechselrichter Sofar Solar xxx TL Generation 2 hinzufügen
   - Hinzufügen des Befehls „refresh“
   - Behebung von Fehlern in der Vorlage
   - Hinzufügen der Dokumentdateien zu den Wechselrichtern, sobald ich sie habe

# 1.0.6 (25.11.2023) => Beta

   - Verbesserung der Verwaltung des Python-Prozesses
   - Behebung einiger Fehler
   - Widget-Kompatibilität für die Datei „sofar_XXTL-G3.yaml“ hinzugefügt
   - Hinzufügen einer Datei, um Befehle an den Wechselrichter senden zu können

# 1.0.5 (11.11.2023) => Beta

   - Hinzufügen einer Vorlage, um die Darstellung bestimmter Daten ansprechender zu gestalten
   - Vorlage OK für SOFAR SOLAR HYD x000 EP
   - Behebung einiger Fehler

# 1.0.4 (29.10.2023) => Beta + stabil
   
   - Fehlerbehebung

# 1.0.3 (29.10.2023) => Beta + stabil
   
   - Hinzufügen von Abhängigkeiten zur Unterstützung von YAMPL für PHP in bestimmten Konfigurationen (Danke, @Loïc)
   - Korrektur einer fehlerhaften Eingabe in den Cron-Jobs + Hinzufügen der Möglichkeit, die Zeit direkt einzugeben (1 oder 5 oder ...)
   - Es ist möglich, Leerzeichen in den Namen der Geräte zu verwenden; in den Protokolldateien werden Leerzeichen jedoch durch „_“ ersetzt
   - Hinzufügen einer neuen Datei für den Wechselrichter Sofar Solar XX TL G3, getestet am SOFAR SOLAR 3000 TL G3 (danke an @Morzini und @Bernard26300)
   - Änderung der Anzeige der Befehle eines Geräts durch Hinzufügen der Register in Dezimal- und Hexadezimalform
   - Verbesserungen und Fehlerbehebungen bei der Abfrage des Wechselrichters
   
# 1.0.2 (19.10.2023) => Beta
   
   - Fehlerbehebung
   - Korrektur der YAML-Konfigurationsdateien
   - Aktualisierung der Bestellungen in der Ausrüstung
   - Hinzufügen einer Funktion zum Scannen des Netzwerks nach kompatiblen Wechselrichtern
   
# 1.0.1 (16.10.2023) => Beta
   
   - Dokumentation
  
  
# 1.0.0 (15.10.2023) => Beta

- Erste funktionsfähige Beta-Version
