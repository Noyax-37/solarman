<br><br><br>

Vorstellung
===
Mit dem Solarman-Plugin können Sie die Daten Ihres Wechselrichters abrufen, der über die Website https://home.solarmanpv.com/ überwacht wird, wie beispielsweise die Sofar Solar HYD-Modelle mit 3 bis 6 kVA.

Automatische Konfigurationsdateien für: Afore_BNTxxxKTL-2mppt, deye_2mppt, deye_4mppt, deye_hybrid, deye_sg04lp3, deye_string, hyd-zss-hp-3k-6k, kstar_hybrid, sofar_g3hyd, sofar_hyd3k-6k-es, sofar_lsw3, sofar_wifikit, sofar_XXTL-G3.yaml, solis_1p8k-5g, solis_3p-4g, solis_hybrid, solis_s6-gr1p, zcs_azzurro-ktl-v3.
<br>

(Nicht vollständige) Liste der derzeit unterstützten Wechselrichter und der zugehörigen Konfigurationsdatei:
<br>
Die Dokumentation zu den Wechselrichtern befindet sich in [diesem Verzeichnis](docs_onduleurs/ )
<br>

| Konfigurationsdatei   | Unterstützte Wechselrichter | Anmerkungen |
|----------------------------|------------------------------------------|-------------------------------------------------------------------------------------------------------------------------------|
| Afore_BNTxxxKTL-2mppt.yaml | ? | |
| deye_2mppt.yaml | DEYE-Mikrowechselrichter mit 2 MPPT-Trackern  | z. B. SUN600G3-EU-230 / SUN800G3-EU-230 / SUN1000G3-EU-230 |
| deye_4mppt.yaml | DEYE-Mikrowechselrichter mit 4 MPPT-Trackern  | z. B. SUN1300G3-EU-230 / SUN1600G3-EU-230 / SUN2000G3-EU-230 |
| deye_hybrid.yaml | DEYE/Sunsynk/SolArk-Hybrid-Wechselrichter     | wird verwendet, wenn keine Nachschlagefunktion angegeben ist |
| deye_sg04lp3.yaml | DEYE/Sunsynk/SolArk Hybrid 8/12K-SG04LP3 | z. B. 12K-SG04LP3-EU |
| deye_string.yaml | DEYE/Sunsynk/SolArk-String-Wechselrichter     | z. B. SUN-4/5/6/7/8/10/12K-G03 Plus |
| hyd-zss-hp-3k-6k.yaml | ? | |
| kstar_hybrid.yaml | ? | |
| sofar_g3hyd.yaml | SOFAR Hybrid-Dreiphasen-Wechselrichter | HYD 6000 oder umbenannte Version (dreiphasig), z. B. ZCS Azzurro 3PH HYD-ZSS |
| sofar_hyd3k-6k-es.yaml     | SOFAR Hybrid-Einphasen-Wechselrichter | Einphasig, kompatibel mit Sofar Solar HYD xxxx ES (getestet mit dem 6000) oder umbenannten Modellen, z. B. ZCS Azzurro HYD-ZSS |
| sofar_hyd-xxktl-3ph.yaml   | SOFAR Hybrid-Dreiphasen-Wechselrichter | Getestet an einem Sofar Hyd 15KTL 3-phasig |
| sofar_lsw3.yaml | SOFAR-Wechselrichter | |
| sofar_TL_G2.yaml | SOFAR-Wechselrichter der 2. Generation | |
| sofar_wifikit.yaml | ? | |
| sofar_XXTL-G3.yaml | SOFAR xxxx TL G3 | Getestet auf Sofar Solar 3000 TL G3 |
| solid_1p8k-5g.yaml | SOLIS 1P8K-5G | |
| solid_3p-4g.yaml | SOLIS 3P-4G | |
| solis_hybrid.yaml | SOLIS Hybrid-Wechselrichter | |
| solid_s6-grip.yaml | SOLIS S6-GRIP | |
| zcs_azzurro-ktl-v3.yaml    | ZCS Azzurro KTL-V3-Wechselrichter | ZCS Azzurro 3,3/4,4/5,5/6,6 KTL-V3 (umbenannte Sofar KTLX-G3) |

<br><br><br><br><br>


Voraussetzungen:
===
Um die Daten Ihres Wechselrichters abrufen zu können, benötigen Sie einen kompatiblen Wechselrichter (unvollständige Liste siehe oben), der mit einem WLAN-Stick ausgestattet ist. Das sieht dann so aus:

* Schlüssel LSW3 (der gängigste):

![WLAN-Schlüssel](cle_wifi.png)

<br>
<br>

* Schlüssel S2-WL-ST (bei bestimmten SOLIS-Wechselrichtern und möglicherweise auch bei anderen Marken)

![Schlüssel 2](clé_S2-WL-ST.jpg)

<br>
<br>

Installation des Plugins
===
Brauchst du eine Erklärung? Okay, sobald das Plugin installiert ist, führe ein Update der Abhängigkeiten durch

<br>
<br>

Allgemeine Konfiguration des Plugins
===
![Allgemeine Einstellungen](recherche.png)

<br>
<br>
Über eine Schaltfläche können die im Netzwerk vorhandenen Wechselrichter gesucht werden; dies funktioniert derzeit nur mit den LSW3-Sticks:
<br>

Um die Protokollstufe zu ändern, muss diese mindestens auf „Info“ eingestellt sein: Klicken Sie auf 1. Wenn die Schaltfläche „Protokoll 3“ nicht angezeigt wird, klicken Sie auf 2 und anschließend auf die Schaltfläche 3.

Hier ist ein Beispiel für einen solchen Log-Eintrag:

![Netzwerk-Suchprotokoll](log_recherche.png)

Sie müssen dann nur noch die IP-Adresse und die Seriennummer in die Konfiguration Ihres Wechselrichters kopieren.

Sonst nichts Besonderes. Ein Bereich, der für eine mögliche Weiterentwicklung nicht zugänglich ist, wobei noch nicht sicher ist, ob diese überhaupt zustande kommt.

<br>
<br>
<br>
<br>
<br>

Neues Gerät anlegen
===
![Neue Ausrüstung](ajout_ondul.png)

Klicken Sie auf das Pluszeichen „Hinzufügen“

## Auswahl
<br>

![Auswahl der Ausrüstung](ajout_ondul1.png)

Geben Sie Ihrem neuen Gerät einen Namen und wählen Sie dann die Vorlagendatei aus, die für die Konfiguration verwendet werden soll

<br>

## Einstellung der Ausrüstung:
<br>

![Gerätekonfiguration](param_equipmnt.png)
<br>
Die ersten Felder sind klassisch.

Danach kann die von Ihnen ausgewählte Konfigurationsdatei nicht mehr bearbeitet werden. Falls Sie einen Fehler gemacht haben, löschen Sie dieses Gerät und erstellen Sie ein neues.

Wählen Sie das WLAN-Schlüsselmodell aus, das auf Ihrem Wechselrichter installiert ist (siehe oben)

Sie müssen die IP-Adresse Ihres WLAN-Adapters, den Port, über den er kommuniziert, und seine Seriennummer eingeben. Der Port lautet in der Regel 8899 oder 502, je nach Modell des installierten Adapters, aber die Seriennummer müssen Sie in den Einstellungen Ihres Adapters nachsehen.

Die Konfigurationsseite wird in Ihrem Webbrowser angezeigt, wenn Sie die Adresse Ihres Sticks eingeben: http://adresse_ip_de_votre_clé_wifi. Der Standard-Benutzername und das Standard-Passwort lauten „admin“, sofern Sie diese nicht geändert haben.

![WLAN-Schlüssel einrichten](param_cle.png)

Wählen Sie anschließend die gewünschte Abfragehäufigkeit aus; zulässig sind nur 1, 5, 10, 15 und 30 Minuten.

Die grüne Schaltfläche am unteren Bildschirmrand dient dazu, die Aktualisierung der Werte Ihres Wechselrichters zu erzwingen

Die orangefarbene Schaltfläche setzt die verwendeten Register auf die Werte der verwendeten Konfigurationsdatei zurück. Dies ist erforderlich, wenn Sie die YAML-Konfigurationsdatei ändern. Beachten Sie jedoch: Wenn Fehler angezeigt werden, bleibt Ihnen nur die Möglichkeit, von vorne zu beginnen und ein neues Gerät anzulegen.


Widget-Vorlage
===

Hinzufügen einer Vorlage (danke an @Phpvarious), mit der die wichtigsten Daten des Wechselrichters anschaulicher dargestellt werden können. Zunächst habe ich die Vorlage nur für meinen Wechselrichter (Sofar Solar HYD xxx ES) ausgefüllt, aber ihr könnt sie selbst anpassen (siehe Konfigurationsdatei unten).

Seit Version 1.0.8 können die Daten für die Vorlage direkt über die Gerätebefehle zugewiesen werden => die YAML-Datei muss nicht mehr geändert werden

![Widget-GIF](widget.gif)

Wenn Sie eine Version installiert haben, die vor der Integration dieses Widgets veröffentlicht wurde, oder wenn Sie die Konfigurationsdatei ändern, müssen Sie in den Geräteeinstellungen auf die Schaltfläche zum Zurücksetzen der Daten klicken.

In den Einstellungen Ihrer Ausrüstung wird nun ein Menüpunkt namens „Vorlage“ angezeigt. Sie können wählen, ob diese Menüpunkte angezeigt werden sollen oder nicht.

![Vorlage 1](template1.jpg)

Wenn Sie im Bereich „Einstellungen“ auf „Anzeige“ gehen, wird das verwendete Widget angezeigt.

![Vorlage 2](template2.jpg)

Wenn Sie nach unten wischen, werden die optionalen Einstellungen des Widgets angezeigt

![Vorlage 3](template3.jpg)


Falls Ihr Wechselrichter nicht in der Liste aufgeführt ist oder Sie die vorhandene Datei anpassen müssen
===

Wenn Sie glauben, dass Ihr Wechselrichter zu den Geräten gehört, die von Solarman überwacht werden können, und Sie wissen, welche Modbus-Register abgefragt werden müssen, können Sie mithilfe der [Vorlagendatei](modele_onduleur.yaml) eine eigene Datei erstellen, wobei Sie die folgenden Grundsätze unbedingt beachten müssen:

## für den Abschnitt „Anfragen“:

Beispiel:

Anfragen:
  - Start: 0x0200
end:  0x0255
mb_functioncode: 0x03
  - Start: 0x10B0
end: 0x10BC
mb_functioncode: 0x04

Sie müssen daher die Modbus-Funktionscodes kennen, die zum Abfragen der Register Ihres Wechselrichters verwendet werden. Für jeden „mb_functioncode“ müssen Sie den Bereich zwischen dem ersten abzufragenden Register („start“) und dem letzten („end“) angeben.

## für den Abschnitt „parameters“:

Beispiel:

Parameter:
 - Gruppe: blablabla
Punkte: bla bla bla
    - name: „Der Name des Registers“
Widget: „Der Name des Widget-Teils (siehe Hilfe unten)“  => ist ab Version 1.0.8 nicht mehr erforderlich
Mann: „Was?“
Maßstab: 0,01
Regel: 1
Register: [0x0200]
  
    - name: „Gesamtproduktion“
Widget: „Der Name des Widget-Teils (siehe Hilfe unten)“  => ist ab Version 1.0.8 nicht mehr erforderlich
Einheit: „kWh“
Maßstab: 1
Regel: 3
Register: [0x0255, 0x0254]
  
    - name: „Netzstrom“
Widget: „Der Name des Widget-Teils (siehe Hilfe unten)“  => ist ab Version 1.0.8 nicht mehr erforderlich
Mann: „A“
Maßstab: 0,01
Regel: 2
Register: [0x10B0]
  
    - name: „Wechselrichterstatus“
widget: "" (diesen Befehl einfügen, wenn diese Information vom Widget nicht verwendet wird)  => ab Version 1.0.8 nicht mehr erforderlich
Mann: ""
Maßstab: 1
Regel: 1
Register: [0x10BC]
isstr: true
Nachschlagewerk:
      -  Schlüssel: 0
Wert: „Standby“
      -  Schlüssel: 1
Wert: „Selbstüberprüfung“
      -  Schlüssel: 2
Wert: „Normal“
      -  Schlüssel: 3
Wert: „Status der Entladung prüfen“
      -  Schlüssel: 4
Wert: „Entladungsstatus“
      -  Schlüssel: 5
Wert: „EPS-Status“
      -  Schlüssel: 6
Wert: „Fehlerzustand“
      -  Schlüssel: 7
Wert: „Dauerzustand“
  
### Erläuterungen

Wichtige Hinweise:

group: Wird im Plugin nicht verwendet, muss aber beibehalten werden; der nachfolgende Text hat keine Funktion. Er muss dennoch beibehalten werden!
items: idem group. Unter dieser Anweisung fassen Sie die verschiedenen Register zusammen, die das Plugin abfragen soll.
name: Name, der in Jeedom für Ihre Bestellung angezeigt wird
Widget: Name des Widget-Teils, der durch diesen Befehl mit Daten versorgt werden soll (siehe Hilfe unten)  => ab Version 1.0.8 nicht mehr erforderlich
uom: Hier wird in Anführungszeichen die Maßeinheit für den im Register gespeicherten Wert angegeben; diese wird in Jeedom verwendet
scale: Zu verwendender Multiplikationsfaktor. Ein Wert von 0,1 wandelt beispielsweise den Wert 100 in 10 um
rule: Regel, die das Plugin anwenden muss, um die in der Registrierung gespeicherten Werte zu interpretieren:
1: vorzeichenlose Ganzzahl => Wert zwischen 0 und 65.535 (FF FF in Hexadezimal)
2: vorzeichenbehaftete Ganzzahl => Wert zwischen -32 768 und +32 768
3: vorzeichenlose Ganzzahl, die über mehrere Bytes gespeichert ist (siehe Abschnitt „Register“)
4: Vorzeichenbehaftete Ganzzahl, die über mehrere Register gespeichert ist
5: ASCII-Wert
6: Verwendung von Bits
7: Version (?)
8: Datum und Uhrzeit
9 Uhr
10: Uhrzeit im Sofar-Format (die 8 höchstwertigen Bits ergeben nach Umwandlung in Dezimalzahlen die Stunden, die 8 niedrigstwertigen Bits ergeben die Minuten)
11: Datum im Sofar-Format (die 8 höchstwertigen Bits ergeben im Dezimalsystem den Monat, die 8 niedrigstwertigen Bits den Tag)
12: Ausgabe der Wochentage im SOFOR-Binärformat (auf 7 Bit, wobei das niedrigstwertige Bit den Montag darstellt)
13: Binäre Ausgabe
Register: Das oder die Register, in denen die Werte gespeichert sind. Immer in Hexadezimalform und in eckigen Klammern (Array) anzugeben. Bei mehreren Registern sind diese durch ein Komma zu trennen und in der Reihenfolge vom höchsten zum niedrigsten Wert aufzulisten.
isstr: optional, wenn false. Gibt bei true an, dass der Wert ein Zeichen ist und unter Verwendung des unten stehenden Lookup-Schlüssels übersetzt werden soll
lookup: Liste der Bedeutung des Registers entsprechend seinem Wert.
Schlüssel: Wert aus der Registrierungsdatenbank, der in Text umgewandelt werden soll
value: Text, der anstelle des Registerwerts angezeigt wird
  
Achten Sie darauf, die Struktur dieser Datei genau einzuhalten: die Bindestriche in bestimmten Zeilen und das Fehlen derselben in anderen, die Einrückungen, die Anführungszeichen oder deren Fehlen usw.

Für das Widget können folgende Informationen eingegeben werden:

![Widget-Hilfe](widget_help.png)

Bildunterschrift:
Schwarz: In der Ausrüstung einzutragende Befehle.
Rot: Optionale Einstellungen.


Weitere Informationen finden Sie auf der Seite von @Phpvarious, die sich ausschließlich mit diesem Widget befasst:

https://phpvarious.github.io/documentation/widget/fr_FR/widget_scenario/distribution_onduleur/


Danksagung
===

Vielen Dank an @jmccrohan für die Entwicklung der hervorragenden Bibliothek pySolarmanV5 [https://pysolarmanv5](https://pysolarmanv5.readthedocs.io/en/stable/#)

Vielen Dank an [@StephaneJoubert](https://github.com/StephanJoubert/home_assistant_solarman), der ein Modul für Home Assistant entwickelt hat, aus dem ich einige Informationen und sehr gut geschriebene Python-Dateien übernommen habe

Vielen Dank an [@Ppvarious](https://phpvarious.github.io/documentation/fr_FR/) für sein tolles Widget.

Vielen Dank schließlich an [@Lydie13](https://community.jeedom.com/u/lydie13), die die Konfigurationsdateien in unsere Sprache übersetzt hat

Fehler
===

Sollte ein Fehler im Plugin auftreten, kannst du um Hilfe bitten:

[https://community.jeedom.com/tag/plugin-solarman](https://community.jeedom.com/tag/plugin-solarman)


Wenn bei der Installation der Abhängigkeiten die Fehlermeldung „Cannot uninstall 'PyYAML'. Es handelt sich um ein mit distutils installiertes Projekt...“ erhalten, gehen Sie zu „Einstellungen/System/Konfiguration“, dann auf den Reiter „>_OS/DB“ und schließlich zu „>_Systemverwaltung“ und führen Sie den Befehl „sudo -H pip3 install --ignore-installed PyYAML“ aus. Starten Sie anschließend die Installation der Abhängigkeiten erneut, und alles sollte wieder funktionieren.

