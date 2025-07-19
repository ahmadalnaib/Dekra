<template>
    <div>
        <div class="showcase-content">
            <h1>Häufig gestellte Fragen</h1>
            <p>Willkommen in unserem Hilfe-Center. Hier finden Sie eine Sammlung der häufigsten Fragen und Antworten zu unseren Services.</p>
            <!-- Search -->
            <div class="search-container">
                <input type="text" v-model="searchQuery" placeholder="Suche nach etwas..." />
                <button @click="performSearch">Suchen</button>
            </div>
            <!-- Categories Section -->
            <div class="categories-section">
                <div
                    class="category-card"
                    v-for="category in categories"
                    :key="category.id"
                    :class="{ active: selectedCategoryId === category.id }"
                    @click="selectCategory(category.id)"
                >
                    <div class="category-icon">
                        <img :src="category.icon" :alt="category.name" />
                    </div>
                    <h3>{{ category.name }}</h3>
                </div>
            </div>
        </div>

        <!-- FAQ Questions Section -->
        <div class="faq-section">
            <div class="faq-container">
                <h2>{{ selectedCategoryId ? getSelectedCategoryName() : 'Häufige Fragen' }}</h2>

                <div class="faq-list">
                    <div class="faq-item" v-for="faq in filteredFaqs" :key="faq.id">
                        <div class="faq-question">
                            <span class="question-text">{{ faq.question }}</span>
                            <button class="faq-toggle" @click="toggleFaq(faq.id)" :class="{ active: openFaqs.includes(faq.id) }">
                                <img
                                    :src="openFaqs.includes(faq.id) ? '/assets/icons/icon-chevron-up.svg' : '/assets/icons/icon-chevron-down.svg'"
                                    :alt="openFaqs.includes(faq.id) ? 'Schließen' : 'Öffnen'"
                                    class="toggle-icon"
                                />
                            </button>
                        </div>

                        <div class="faq-answer" v-show="openFaqs.includes(faq.id)">
                            <p>{{ faq.answer }}</p>
                        </div>
                    </div>
                </div>

                <!-- No FAQs message -->
                <div v-if="filteredFaqs.length === 0" class="no-faqs">
                    <p>Keine Fragen in dieser Kategorie gefunden.</p>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { computed, ref } from 'vue';

const props = defineProps({
    categories: {
        type: Array,
        required: true,
    },
    faqs: {
        type: Array,
        required: true,
    },
});

// Reactive state
const selectedCategoryId = ref(null);
const searchQuery = ref('');
const openFaqs = ref([]);

// Computed properties
const filteredFaqs = computed(() => {
    let filtered = props.faqs;

    // Filter by category
    if (selectedCategoryId.value !== null) {
        filtered = filtered.filter((faq) => faq.category && faq.category.id === selectedCategoryId.value);
    }

    // Filter by search query
    if (searchQuery.value.trim()) {
        const query = searchQuery.value.toLowerCase();
        filtered = filtered.filter(
            (faq) =>
                faq.question.toLowerCase().includes(query) ||
                faq.answer.toLowerCase().includes(query) ||
                (faq.category && faq.category.name.toLowerCase().includes(query)),
        );
    }

    return filtered;
});

// Methods
const selectCategory = (categoryId) => {
    selectedCategoryId.value = categoryId;
    // Close all open FAQs when switching categories
    openFaqs.value = [];
};

const toggleFaq = (faqId) => {
    const index = openFaqs.value.indexOf(faqId);
    if (index > -1) {
        openFaqs.value.splice(index, 1);
    } else {
        openFaqs.value.push(faqId);
    }
};

const getSelectedCategoryName = () => {
    const category = props.categories.find((cat) => cat.id === selectedCategoryId.value);
    return category ? category.name : 'Häufige Fragen';
};


</script>

<style scoped>
.category-card {
    cursor: pointer;
    transition: all 0.2s ease;
    position: relative;
}

.category-card:hover {
    transform: translateY(-2px);
}

.category-card.active {
    border: 2px solid #006b52;

}

.no-faqs {
    text-align: center;
    padding: 2rem;
    color: #666;
}

.search-container input {
    margin-right: 0.5rem;
}
</style>
