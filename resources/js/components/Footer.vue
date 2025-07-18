<template>
    <div>


        <!-- Contact Section -->
        <div class="contact-section">
            <div class="contact-container">
                <div class="contact-content">
                    <div class="contact-text">
                        <h3>Haben Sie Ihre Frage nicht gefunden?</h3>
                        <p>Kein Problem! Unser Support-Team hilft Ihnen gerne weiter. <br>Schreiben Sie uns eine Nachricht und wir melden uns schnellstmöglich bei Ihnen zurück.</p>
                    </div>
                    <div class="contact-button">
                        <button class="write-us-btn">
                            Schreiben Sie uns
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer Section -->
        <div class="footer-section">
            <div class="footer-container">
                <p>2025 | DEKRA gmbh</p>
            </div>
        </div>
    </div>
</template>

<script setup >
</script>




<style  scoped>

/* Contact Section */
.contact-section {
    background-color: var(--clr-brightgreen-100); /* Light green background */
    padding: 20px 10px;
    display: flex;
    justify-content: center;
    align-items: center;
    max-width: 1200px;
    margin: 100px auto;
    border-radius: 15px;
}



.contact-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 2rem;
}

.contact-text {
    flex: 1;
    text-align: left;
}

.contact-text h3 {
    color: var(--clr-darkgreen-700); /* Dark green text */
    font-size: 1.8rem;
    margin-bottom: 1rem;
    font-weight: bold;
}

.contact-text p {
    color: var(--clr-darkgreen-600); /* Dark green text */
    font-size: 1.1rem;
    line-height: 1.6;
    margin: 0;
}

.contact-button {
    flex-shrink: 0;
}

.write-us-btn {
    background: var(--clr-darkgreen-500);
    color: white;
    border: none;
    border-radius: 8px;
    padding: 15px 30px;
    font-size: 1.1rem;
    font-weight: bold;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: 0 3px 10px rgba(0, 0, 0, 0.2);
}

.write-us-btn:hover {
    background: var(--clr-darkgreen-700);
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
}

/* Footer Section */
.footer-section {
 
    padding: 30px 20px;
    text-align: center;
}

.footer-container {
    max-width: 1200px;
    margin: 0 auto;
}

.footer-section p {
    color: gray;
    font-size: 1rem;
    margin: 0;
    font-weight: 500;
}

/* Mobile responsive */
@media (max-width: 768px) {
    .faq-section {
        padding: 40px 15px;
        margin-top: 50px;
    }
    
    .faq-section h2 {
        font-size: 1.8rem;
    }
    
    .faq-question {
        padding: 1rem;
    }
    
    .question-text {
        font-size: 1rem;
    }
    
    .faq-toggle {
        width: 35px;
        height: 35px;
    }
    
    .toggle-icon {
        width: 16px;
        height: 16px;
    }
    
    .faq-answer {
        padding: 1rem;
    }

    .contact-content {
        flex-direction: column;
        text-align: center;
    }

    .contact-text {
        text-align: center;
    }

    .contact-text h3 {
        font-size: 1.5rem;
    }

    .contact-text p {
        font-size: 1rem;
    }

    .write-us-btn {
        padding: 12px 24px;
        font-size: 1rem;
    }
}
</style>