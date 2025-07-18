<template>
    <div>
        <div class="showcase-content">
            <h1>Häufig gestellte Fragen</h1>
            <p>Willkommen in unserem Hilfe-Center. Hier finden Sie eine Sammlung der häufigsten Fragen und Antworten zu unseren Services.</p>
            <!-- Search -->
            <div class="search-container">
                <input type="text" placeholder="Suche nach etwas..." />
                <button>Suchen</button>
            </div>
            <!-- Categories Section -->
            <div class="categories-section">
                <div class="category-card">
                    <div class="category-icon">
                        <img src="/assets/icons/icon-categorie-allgemeines.svg" alt="Support" />
                    </div>
                    <h3>Technischer Support</h3>
                </div>

                <div class="category-card">
                    <div class="category-icon">
                        <img src="/assets/icons/icon-categorie-services.svg" alt="Billing" />
                    </div>
                    <h3>Abrechnung</h3>
                </div>

                <div class="category-card">
                    <div class="category-icon">
                        <img src="/assets/icons/icon-categorie-medien.svg" alt="Account" />
                    </div>
                    <h3>Account & Profile</h3>
                </div>

                <div class="category-card">
                    <div class="category-icon">
                        <img src="/assets/icons/icon-categorie-payment.svg" alt="Services" />
                    </div>
                    <h3>Services</h3>
                </div>
            </div>
        </div>

        <!-- FAQ Questions Section -->
        <div class="faq-section">
            <div class="faq-container">
                <h2>Häufige Fragen</h2>
                
                <div class="faq-list">
                    <div class="faq-item" v-for="(faq, index) in faqs" :key="index">
                        <div class="faq-question">
                            <span class="question-text">{{ faq.question }}</span>
                            <button 
                                class="faq-toggle" 
                                @click="toggleFaq(index)"
                                :class="{ 'active': faq.isOpen }"
                            >
                                <img 
                                    :src="faq.isOpen ? '/assets/icons/icon-chevron-up.svg' : '/assets/icons/icon-chevron-down.svg'" 
                                    :alt="faq.isOpen ? 'Schließen' : 'Öffnen'"
                                    class="toggle-icon"
                                />
                            </button>
                        </div>
                        
                        <div class="faq-answer" v-show="faq.isOpen">
                            <p>{{ faq.answer }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import { ref } from 'vue'

interface FAQ {
    question: string
    answer: string
    isOpen: boolean
}

const faqs = ref<FAQ[]>([
    {
        question: "Wie kann ich mein Passwort zurücksetzen?",
        answer: "Sie können Ihr Passwort über die 'Passwort vergessen' Funktion auf der Anmeldeseite zurücksetzen. Geben Sie Ihre E-Mail-Adresse ein und folgen Sie den Anweisungen in der E-Mail, die Sie erhalten.",
        isOpen: false
    },
    {
        question: "Wie kann ich meine Rechnungsdaten ändern?",
        answer: "Loggen Sie sich in Ihr Konto ein und gehen Sie zu den Kontoeinstellungen. Dort finden Sie den Bereich 'Rechnungsinformationen', wo Sie Ihre Daten aktualisieren können.",
        isOpen: false
    },
    {
        question: "Welche Zahlungsmethoden werden akzeptiert?",
        answer: "Wir akzeptieren alle gängigen Kreditkarten (Visa, MasterCard, American Express), PayPal, Banküberweisung und SEPA-Lastschrift für deutsche Kunden.",
        isOpen: false
    },
    {
        question: "Wie kann ich den technischen Support kontaktieren?",
        answer: "Sie können uns per E-Mail an support@dekra.de erreichen, über unser Kontaktformular auf der Website oder telefonisch unter +49 711 7861-0 während unserer Geschäftszeiten (Mo-Fr 8:00-18:00 Uhr).",
        isOpen: false
    },
    {
        question: "Wie lange dauert die Bearbeitung meiner Anfrage?",
        answer: "Die meisten Anfragen werden innerhalb von 24-48 Stunden bearbeitet. Bei komplexeren technischen Problemen kann die Bearbeitung bis zu 5 Werktage dauern. Sie erhalten eine Bestätigung und regelmäßige Updates per E-Mail.",
        isOpen: false
    }
])

const toggleFaq = (index: number) => {
    faqs.value[index].isOpen = !faqs.value[index].isOpen
}
</script>