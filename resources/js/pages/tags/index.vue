<template>
    <div>
        <Head title="Tag Verwaltung" />
        <NavWelcome />

        <div class="showcase-content">
            <h1>Tag Verwaltung</h1>
            <p>
                Hier verwalten Sie die Schlagwörter (Tags) für Ihre Inhalte. Erstellen, bearbeiten und organisieren Sie Tags, um die Auffindbarkeit
                und Kategorisierung Ihrer digitalen Trainings zu optimieren.
            </p>
        </div>

        <!-- FAQ Management Section -->
        <div class="faq-management-section">
            <!-- Controls -->
            <div class="controls-section">
                <div class="count-section">
                    <h3>Insgesamt {{ filteredTags.length }} von {{ props.tags.total }} Tags</h3>
                </div>

                <div class="search-box">
                    <input type="text" v-model="searchQuery" placeholder="Tags durchsuchen..." class="search-input" />
                    <button class="search-btn" @click="performSearch">
                        <img src="/assets/icons/search-light.svg" alt="Search Icon" class="search-icon" />
                        Suchen
                    </button>
                </div>

                <button class="create-btn" @click="createNewTag">
                    <img src="/assets/icons/add.svg" alt="Add Icon" class="search-icon" />
                    Neue Tag erstellen
                </button>
            </div>

            <!-- FAQ Table -->
            <div class="table-container">
                <table class="faq-table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Erstellt am</th>
                            <th>Aktionen</th>
                        </tr>
                    </thead>
                    <tbody>
                        <template v-if="filteredTags.length > 0">
                            <tr v-for="tag in filteredTags" :key="tag.id">
                                <td>{{ tag.name }}</td>
                                <td>{{ formatDateTime(tag.created_at) }}</td>
                                <td class="actions">
                                    <button class="action-btn view-btn" @click="editTag(tag)">
                                        <img src="/assets/icons/icon-edit.svg" alt="Edit" />
                                    </button>
                                    <button class="action-btn delete-btn" @click="showDeleteModal(tag)">
                                        <img src="/assets/icons/icon-delete.svg" alt="Delete" />
                                    </button>
                                </td>
                            </tr>
                        </template>
                        <tr v-else>
                            <td colspan="3" class="py-4 text-center text-gray-500">Keine Tags gefunden.</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <Pagination :pagination="tags" />

        <!-- Tag Modal -->
        <TagModal :show="showModal" :tag="selectedTag" :tags="tags" @close="closeModal" @success="handleSuccess" />

        <!-- Delete Confirmation Modal -->
        <DeleteConfirmationModal
            :show="showDeleteConfirmation"
            title="Tag löschen"
            :message="`Sind Sie sicher, dass Sie den Tag '${tagToDelete?.name}' löschen möchten?`"
            description="Diese Aktion kann nicht rückgängig gemacht werden."
            @close="closeDeleteModal"
            @confirm="confirmDelete"
        />
    </div>
</template>

<script setup>
import DeleteConfirmationModal from '@/components/DeleteConfirmationModal.vue';
import NavWelcome from '@/components/NavWelcome.vue';
import Pagination from '@/components/Pagination.vue';
import TagModal from '@/components/TagModal.vue';
import { Head, router } from '@inertiajs/vue3';
import { computed, ref } from 'vue';

const props = defineProps({
    tags: {
        type: Object,
        required: true,
    },
});

const searchQuery = ref('');
const showModal = ref(false);
const selectedTag = ref(null);
const showDeleteConfirmation = ref(false);
const tagToDelete = ref(null);

const filteredTags = computed(() => {
    // Access the data array from the paginated response
    const tagsData = props.tags.data || [];

    if (!searchQuery.value) return tagsData;
    return tagsData.filter((tag) => tag.name?.toLowerCase().includes(searchQuery.value.toLowerCase()));
});

const formatDateTime = (dateTime) => {
    if (!dateTime) return '-';
    const date = new Date(dateTime);
    return date.toLocaleDateString('de-DE');
};

const createNewTag = () => {
    selectedTag.value = null;
    showModal.value = true;
};

const editTag = (tag) => {
    selectedTag.value = tag;
    showModal.value = true;
};

const showDeleteModal = (tag) => {
    tagToDelete.value = tag;
    showDeleteConfirmation.value = true;
};

const closeDeleteModal = () => {
    showDeleteConfirmation.value = false;
    tagToDelete.value = null;
};

const confirmDelete = async () => {
    if (!tagToDelete.value) return;

    return new Promise((resolve, reject) => {
        router.delete(`/tags/${tagToDelete.value.id}`, {
            onSuccess: () => {
                console.log('Tag deleted successfully');
                closeDeleteModal();
                resolve();
            },
            onError: (errors) => {
                console.error('Error deleting Tag:', errors);
                reject(errors);
            },
        });
    });
};

const closeModal = () => {
    showModal.value = false;
    selectedTag.value = null;
};
</script>
