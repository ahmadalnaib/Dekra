<?php


namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('faqs')->truncate();

        $faqs = [
            [
                'category_id' => 1, // Allgemein
                'question' => 'Wie kann ich mich für einen Kurs anmelden?',
                'answer' => 'Die Anmeldung für unsere digitalen Kurse ist unkompliziert und erfolgt direkt online über unsere Webseite. Navigieren Sie einfach zu dem gewünschten Kursangebot, das Sie interessiert. Dort finden Sie einen "Jetzt anmelden"-Button, der Sie durch den weiteren Prozess führt. Sie werden Schritt für Schritt durch die Eingabe Ihrer Daten und die Auswahl der Zahlungsoptionen geleitet. Sollten während des Anmeldevorgangs Fragen oder Schwierigkeiten auftreten, steht Ihnen unser engagiertes Support-Team jederzeit per E-Mail oder Telefon zur Verfügung, um Ihnen schnell und kompetent weiterzuhelfen.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'category_id' => 1, // Allgemein
                'question' => 'Gibt es eine Altersbeschränkung für die Teilnahme an Kursen?',
                'answer' => 'Unsere Kurse sind prinzipiell so konzipiert, dass sie eine breite Zielgruppe ansprechen. Generell richten sich unsere digitalen Trainings primär an Erwachsene und Fachkräfte, die ihre Kenntnisse erweitern oder neue Kompetenzen erwerben möchten. Sollten für spezifische Kurse bestimmte Alters- oder fachliche Zugangsvoraussetzungen notwendig sein, sind diese detailliert in der jeweiligen Kursbeschreibung auf unserer Webseite aufgeführt. Wir empfehlen Ihnen, diese Informationen vor der Anmeldung genau zu prüfen.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'category_id' => 1, // Allgemein
                'question' => 'Erhalte ich nach Kursabschluss eine Bescheinigung oder ein Zertifikat?',
                'answer' => 'Ja, der erfolgreiche Abschluss unserer Kurse wird selbstverständlich bescheinigt! Nach dem Absolvieren aller Kursmodule und gegebenenfalls der erfolgreichen Teilnahme an Tests oder Abschlussaufgaben erhalten Sie ein hochwertiges digitales Zertifikat oder eine offizielle Teilnahmebescheinigung. Dieses Dokument bestätigt Ihre erworbenen Kenntnisse und Fähigkeiten und kann als Nachweis für Ihre berufliche Weiterbildung oder persönliche Entwicklung dienen. Das Zertifikat wird Ihnen in der Regel automatisch in Ihrem Benutzerkonto zum Download bereitgestellt.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'category_id' => 1, // Allgemein
                'question' => 'Wie lange habe ich Zugriff auf einen gebuchten Kurs?',
                'answer' => 'Der Zugriff auf unsere Kurse variiert je nach Kursart und Buchungsmodell. In der Regel haben Sie nach der Buchung und Freischaltung des Kurses für einen Zeitraum von [z.B. 12 Monaten] unbegrenzten Zugriff auf alle Inhalte. Bei Zertifikatskursen, die mit einer Prüfung enden, kann der Zugang nach bestandener Prüfung angepasst werden. Detaillierte Informationen zur Zugriffszeit finden Sie immer in der jeweiligen Kursbeschreibung auf unserer Webseite, damit Sie Ihre Lernzeit optimal planen können.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'category_id' => 1, // Allgemein
                'question' => 'Gibt es regelmäßige Updates der Kursinhalte?',
                'answer' => 'Ja, unsere digitalen Trainings werden kontinuierlich überprüft und aktualisiert, um sicherzustellen, dass die Inhalte stets aktuell sind und den neuesten Entwicklungen in den jeweiligen Fachgebieten entsprechen. Wir passen uns an neue Erkenntnisse, Technologien oder gesetzliche Änderungen an. Wenn ein Kurs ein größeres Update erhält, informieren wir Sie darüber und erklären, wie Sie auf die neuen Versionen zugreifen können, falls Sie bereits Teilnehmer sind. Unser Ziel ist es, Ihnen stets die relevantesten und aktuellsten Informationen zur Verfügung zu stellen.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'category_id' => 2, // Services
                'question' => 'Bieten Sie auch individuelle Trainings für Unternehmen an?',
                'answer' => 'Absolut! Neben unserem umfangreichen Angebot an Standardkursen sind wir spezialisiert auf die Entwicklung maßgeschneiderter digitaler Trainingslösungen für Unternehmen jeder Größe und Branche. Wir analysieren gemeinsam mit Ihnen den spezifischen Schulungsbedarf Ihrer Mitarbeiter und konzipieren interaktive E-Learnings, Online-Unterweisungen oder Blended-Learning-Konzepte, die perfekt auf Ihre Unternehmensziele abgestimmt sind. Kontaktieren Sie uns gerne für ein unverbindliches Erstgespräch, in dem wir Ihre Anforderungen detailliert besprechen und erste Lösungsansätze skizzieren können.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'category_id' => 2, // Services
                'question' => 'Können wir Ihre Lernplattform auch für unsere internen Schulungen nutzen?',
                'answer' => 'Ja, das ist eine unserer Kernkompetenzen! Wir bieten flexible Lizenzmodelle und umfassende Anpassungsmöglichkeiten unserer leistungsstarken Lernplattform an, damit Sie diese optimal für Ihre unternehmensinternen Schulungszwecke nutzen können. Von der Integration in Ihre bestehende IT-Infrastruktur über das Branding im Corporate Design bis hin zur Verwaltung von Benutzergruppen und Fortschrittsberichten – unsere Plattform kann an Ihre Bedürfnisse angepasst werden. Sprechen Sie uns an, um mehr über die technischen Implementierungsmöglichkeiten und die Vorteile für Ihr Unternehmen zu erfahren.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'category_id' => 2, // Services
                'question' => 'Unterstützen Sie uns bei der Erstellung eigener Lerninhalte?',
                'answer' => 'Sehr gerne! Unser erfahrenes Team begleitet Sie umfassend bei der Konzeption, Entwicklung und Produktion Ihrer eigenen E-Learnings, Online-Unterweisungen und anderer digitaler Trainingsformate. Egal ob Sie bestehende Präsenzschulungen digitalisieren oder komplett neue Inhalte erstellen möchten – wir bringen Ihre Expertise didaktisch sinnvoll und visuell ansprechend in digitale Lernmodule. Von der Drehbucherstellung über die Medienproduktion (Video, Audio, Animation) bis zur technischen Umsetzung unterstützen wir Sie dabei, Ihre Botschaften effektiv und nachhaltig zu vermitteln.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'category_id' => 2, // Services
                'question' => 'Bieten Sie auch Support und technischen Beistand während der Kurslaufzeit an?',
                'answer' => 'Selbstverständlich! Unser Support-Team steht Ihnen während der gesamten Kurslaufzeit zur Seite, falls Sie technische Probleme mit der Lernplattform haben oder Fragen zu den Kursinhalten aufkommen. Sie können uns bequem per E-Mail oder über unser Kontaktformular erreichen. Wir sind bestrebt, Ihre Anfragen schnellstmöglich und kompetent zu beantworten, damit Ihr Lernerfolg nicht durch technische Hürden beeinträchtigt wird. Unser Ziel ist ein reibungsloses und effektives Lernerlebnis für alle Teilnehmer.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'category_id' => 2, // Services
                'question' => 'Können wir einen Demo-Zugang zu Ihrer Lernplattform erhalten?',
                'answer' => 'Gerne bieten wir Ihnen die Möglichkeit, unsere Lernplattform und ausgewählte Kursinhalte in einem Demo-Zugang unverbindlich kennenzulernen. So können Sie sich selbst ein Bild von der Benutzerfreundlichkeit, den interaktiven Funktionen und der Qualität unserer Materialien machen. Bitte kontaktieren Sie uns über unser Kontaktformular oder telefonisch, um einen individuellen Demo-Zugang für Ihr Unternehmen oder für persönliche Testzwecke anzufragen. Wir freuen uns darauf, Ihnen die Vorteile unserer Plattform persönlich vorzustellen.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'category_id' => 3, // Medien
                'question' => 'Kann ich die Kursmaterialien auch nach Abschluss des Trainings noch herunterladen?',
                'answer' => 'Ja, selbstverständlich! Unser Ziel ist es, Ihnen nachhaltigen Zugang zu den Lerninhalten zu ermöglichen. Daher sind die meisten digitalen Kursmaterialien, wie beispielsweise Skripte, Präsentationen, Checklisten, Arbeitsblätter oder ergänzende Dokumente, auch nach dem offiziellen Kursabschluss weiterhin für Sie in Ihrem persönlichen Benutzerbereich auf unserer Lernplattform verfügbar. Sie können diese jederzeit herunterladen, um das Gelernte zu wiederholen, zu vertiefen oder als Nachschlagewerk zu nutzen.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'category_id' => 3, // Medien
                'question' => 'Sind Ihre Lernvideos auch auf mobilen Geräten abspielbar?',
                'answer' => 'Ja, die Kompatibilität mit mobilen Geräten ist uns sehr wichtig! Alle unsere Lernvideos und interaktiven Medieninhalte werden responsiv ausgeliefert. Das bedeutet, sie sind für eine optimale Darstellung und reibungslose Abspielbarkeit auf einer Vielzahl von Geräten optimiert – sei es auf Ihrem Desktop-Computer, Tablet oder Smartphone. So können Sie flexibel und jederzeit lernen, wo und wann es Ihnen am besten passt, ohne Kompromisse bei der Qualität oder Nutzererfahrung eingehen zu müssen.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'category_id' => 3, // Medien
                'question' => 'In welchen Sprachen werden die Lerninhalte angeboten?',
                'answer' => 'Unsere Lerninhalte werden primär in [Hauptsprache, z.B. Deutsch] entwickelt und angeboten. Wir verstehen jedoch die Bedeutung mehrsprachiger Lernangebote. Für ausgewählte Kurse und Trainings stehen daher auch Inhalte in [weitere Sprachen, z.B. Englisch, Französisch oder Spanisch] zur Verfügung. Die genauen Informationen zu den verfügbaren Sprachen finden Sie stets in der detaillierten Beschreibung des jeweiligen Kurses auf unserer Webseite. Sollten Sie Bedarf an spezifischen Sprachversionen haben, können Sie uns gerne kontaktieren.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'category_id' => 3, // Medien
                'question' => 'Sind die Videos mit Untertiteln verfügbar?',
                'answer' => 'Ja, die Barrierefreiheit unserer Lernmedien ist uns ein wichtiges Anliegen. Viele unserer Lernvideos sind mit Untertiteln versehen, um das Verständnis zu erleichtern und auch Lernenden mit Hörbeeinträchtigungen oder in lauten Umgebungen das Lernen zu ermöglichen. Informationen zur Verfügbarkeit von Untertiteln finden Sie jeweils in der Kursbeschreibung oder direkt im Videoplayer des Kurses. Wir arbeiten kontinuierlich daran, unser Angebot an barrierefreien Inhalten zu erweitern.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'category_id' => 3, // Medien
                'question' => 'Kann ich die Inhalte auch offline nutzen?',
                'answer' => 'Die Möglichkeit zur Offline-Nutzung hängt vom jeweiligen Kursformat ab. Während unsere Lernplattform primär eine Online-Anbindung erfordert, können herunterladbare Materialien wie PDFs oder Arbeitsblätter selbstverständlich offline genutzt werden. Für spezifische Kurse oder Lernmodule prüfen wir derzeit Lösungen, um eine eingeschränkte Offline-Nutzung über unsere App oder spezielle Download-Funktionen zu ermöglichen. Bitte informieren Sie sich in der Kursbeschreibung, ob für Ihr gewünschtes Training Offline-Optionen zur Verfügung stehen.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'category_id' => 4, // Zahlungen
                'question' => 'Welche Zahlungsmöglichkeiten stehen mir zur Verfügung?',
                'answer' => 'Um Ihnen den Buchungsprozess so einfach und flexibel wie möglich zu gestalten, bieten wir Ihnen verschiedene sichere und bequeme Zahlungsmöglichkeiten an. Dazu gehören gängige Optionen wie Kreditkarte (Visa, MasterCard, American Express), PayPal, und für bestimmte Angebote auch die klassische Banküberweisung. Alle verfügbaren Zahlungsoptionen werden Ihnen transparent während des Anmeldeprozesses für Ihren gewählten Kurs angezeigt, sodass Sie die für Sie passende Methode auswählen können.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'category_id' => 4, // Zahlungen
                'question' => 'Erhalte ich eine Rechnung für meine Kursbuchung?',
                'answer' => 'Ja, selbstverständlich! Nach erfolgreicher Buchung und dem Eingang Ihrer Zahlung erhalten Sie automatisch eine detaillierte Rechnung an die von Ihnen während der Anmeldung angegebene E-Mail-Adresse. Diese Rechnung dient als offizieller Zahlungsbeleg und enthält alle relevanten Informationen wie den Kurstitel, den Preis und die Mehrwertsteuer. Bei Bedarf für Ihre Buchhaltung oder Steuererklärung ist sie somit jederzeit verfügbar.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'category_id' => 4, // Zahlungen
                'question' => 'Gibt es die Möglichkeit einer Ratenzahlung für längere Kurse?',
                'answer' => 'Für bestimmte, insbesondere längere und höherpreisige Kursangebote, möchten wir Ihnen die Finanzierung erleichtern. Daher bieten wir unter Umständen die Möglichkeit einer flexiblen Ratenzahlung an. Dies ermöglicht Ihnen, die Kursgebühren in mehreren Teilbeträgen über einen vereinbarten Zeitraum zu begleichen. Die genauen Konditionen und ob eine Ratenzahlung für den von Ihnen gewählten Kurs verfügbar ist, können Sie den spezifischen Kursinformationen entnehmen oder gerne direkt bei unserem Support-Team erfragen. Wir beraten Sie hierzu gerne persönlich.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'category_id' => 4, // Zahlungen
                'question' => 'Fallen zusätzliche Kosten an, die nicht im Kurspreis enthalten sind?',
                'answer' => 'Der angegebene Kurspreis beinhaltet in der Regel alle für den Kurs relevanten Leistungen und Materialien. Es gibt keine versteckten Kosten. Eventuelle Ausnahmen, wie beispielsweise optional buchbare Präsenzseminare, externe Prüfungsgebühren bei Zertifizierungen durch Dritte oder Versandkosten für physische Materialien, werden stets transparent in der jeweiligen Kursbeschreibung aufgeführt. Bitte prüfen Sie die Kursdetails sorgfältig, um den genauen Umfang der im Preis enthaltenen Leistungen zu erfahren.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'category_id' => 4, // Zahlungen
                'question' => 'Was passiert, wenn ich einen Kurs stornieren muss?',
                'answer' => 'Sollten Sie einen gebuchten Kurs stornieren müssen, gelten unsere Stornierungsbedingungen, die Sie in unseren Allgemeinen Geschäftsbedingungen (AGB) finden. Abhängig vom Zeitpunkt der Stornierung und der Art des Kurses können unterschiedliche Regelungen greifen, wie zum Beispiel eine kostenfreie Stornierung innerhalb einer bestimmten Frist oder eine anteilige Rückerstattung. Wir empfehlen Ihnen, sich bei Stornierungswünschen so früh wie möglich an unser Support-Team zu wenden, um die beste Lösung für Ihre Situation zu finden.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        DB::table('faqs')->insert($faqs);
    }
}