<template>
    <Head title="FAQ Verwaltung" />
    <div>
        <NavWelcome />

        <div class="showcase-content">
            <h1>FAQ Verwaltung</h1>
            <p>
                Willkommen im internen Tool zur Verwaltung von häufig gestellten Fragen. Hire Sie neue Fragen für Quizzes,Tests order FAQs erstellen,
                bearbeiten Fragen anpassen und Ihre Fragensammlungen effizient organisieren.
            </p>
        </div>

        <!-- FAQ Management Section -->
        <div class="faq-management-section">
            <!-- Controls -->
            <div class="controls-section">
                <div class="count-section">
                    <h3>Insgesamt {{ filteredFaqs.length }} von {{ props.faqs.total }} Fragen</h3>
                </div>

                <div class="search-box">
                    <input type="text" v-model="searchQuery" placeholder="FAQs durchsuchen..." class="search-input" />
                    <button class="search-btn" @click="performSearch">
                        <img src="/assets/icons/search-light.svg" alt="Search Icon" class="search-icon" />
                        Suchen
                    </button>
                </div>

                <button class="create-btn" @click="createNewFaq">
                    <img src="/assets/icons/add.svg" alt="Add Icon" class="search-icon" />
                    Neue FAQ erstellen
                </button>
            </div>

            <!-- FAQ Table -->
            <div class="table-container">
                <table class="faq-table">
                    <thead>
                        <tr>
                            <th>Frage</th>
                            <th>Kategorie</th>
                            <th>Erstellt am</th>
                            <th>Aktionen</th>
                        </tr>
                    </thead>
                    <tbody>
                        <template v-if="filteredFaqs.length > 0">
                            <tr v-for="faq in filteredFaqs" :key="faq.id">
                                <td>{{ faq.question }}</td>
                                <td>
                                    <span class="category-badge">
                                        {{ faq.category?.name || 'Keine Kategorie' }}
                                    </span>
                                </td>
                                <td>{{ formatDateTime(faq.created_at) }}</td>
                                <td class="actions">
                                    <button class="action-btn view-btn" @click="editFaq(faq)">
                                        <img src="/assets/icons/icon-edit.svg" alt="View" />
                                    </button>
                                    <button class="action-btn delete-btn" @click="showDeleteModal(faq)">
                                        <img src="/assets/icons/icon-delete.svg" alt="Delete" />
                                    </button>
                                    <button class="action-btn edit-btn">
                                        <img src="/assets/icons/icon-sort-up.svg" alt="Edit" />
                                    </button>
                                    <button class="action-btn delete-btn">
                                        <img src="/assets/icons/icon-sort-down.svg" alt="Delete" />
                                    </button>
                                </td>
                            </tr>
                        </template>
                        <tr v-else>
                            <td colspan="4" class="py-4 text-center text-gray-500">Keine Fragen gefunden.</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <!--  Pagination -->
        <div class="m-4">
            <Pagination :pagination="faqs" />
        </div>

        <!-- FAQ Modal -->
        <FaqModal :show="showModal" :faq="selectedFaq" :categories="categories" :tags="tags" @close="closeModal" @success="handleSuccess" />

        <!-- Delete Confirmation Modal -->
        <DeleteConfirmationModal
            :show="showDeleteConfirmation"
            title="FAQ löschen"
            :message="`Sind Sie sicher, dass Sie die FAQ '${faqToDelete?.question}' löschen möchten?`"
            description="Diese Aktion kann nicht rückgängig gemacht werden."
            @close="closeDeleteModal"
            @confirm="confirmDelete"
        />
    </div>
</template>

<script setup>
import DeleteConfirmationModal from '@/components/DeleteConfirmationModal.vue';
import FaqModal from '@/components/FaqModal.vue';
import NavWelcome from '@/components/NavWelcome.vue';
import Pagination from '@/components/Pagination.vue';
import { Head, router } from '@inertiajs/vue3';
import { computed, ref } from 'vue';

const props = defineProps({
    faqs: {
        type: Object,
        required: true,
    },
    categories: {
        type: Array,
        default: () => [],
    },
    tags: {
        type: Array,
        default: () => [],
    },
});

const searchQuery = ref('');
const showModal = ref(false);
const selectedFaq = ref(null);
const showDeleteConfirmation = ref(false);
const faqToDelete = ref(null);

const filteredFaqs = computed(() => {
    if (!searchQuery.value) return props.faqs.data;
    return props.faqs.data.filter(
        (faq) =>
            faq.question.toLowerCase().includes(searchQuery.value.toLowerCase()) ||
            faq.category?.name?.toLowerCase().includes(searchQuery.value.toLowerCase()),
    );
});

const performSearch = () => {
    console.log('Search query:', searchQuery.value);
};

const formatDateTime = (dateTime) => {
    if (!dateTime) return '-';
    const date = new Date(dateTime);
    return date.toLocaleDateString('de-DE');
};

const createNewFaq = () => {
    selectedFaq.value = null;
    showModal.value = true;
};

const editFaq = (faq) => {
    selectedFaq.value = faq;
    showModal.value = true;
};

const showDeleteModal = (faq) => {
    faqToDelete.value = faq;
    showDeleteConfirmation.value = true;
};

const closeDeleteModal = () => {
    showDeleteConfirmation.value = false;
    faqToDelete.value = null;
};

const confirmDelete = async () => {
    if (!faqToDelete.value) return;

    return new Promise((resolve, reject) => {
        router.delete(`/faqs/${faqToDelete.value.id}`, {
            onSuccess: () => {
                console.log('FAQ deleted successfully');
                closeDeleteModal();
                resolve();
            },
            onError: (errors) => {
                console.error('Error deleting FAQ:', errors);
                reject(errors);
            },
        });
    });
};

const closeModal = () => {
    showModal.value = false;
    selectedFaq.value = null;
};
</script>
