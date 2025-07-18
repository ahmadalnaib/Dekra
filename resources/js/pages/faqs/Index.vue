<template>
  <div>
    <NavWelcome />

    <div class="showcase-content">
      <h1>Häufig gestellte Fragen</h1>
      <p>
        Willkommen in unserem Hilfe-Center. Hier finden Sie eine Sammlung der
        häufigsten Fragen und Antworten zu unseren Services.
      </p>
    </div>

    <!-- FAQ Management Section -->
    <div class="faq-management-section">
      <!-- Controls -->
      <div class="controls-section">
        <div class="count-section">
          <h3>
            Insgesamt {{ filteredFaqs.length }} von {{ props.faqs.total }} Fragen
          </h3>
        </div>

        <div class="search-box">
          <input
            type="text"
            v-model="searchQuery"
            placeholder="FAQs durchsuchen..."
            class="search-input"
          />
          <button class="search-btn" @click="performSearch">
            <i class="fas fa-search"></i>
            Suchen
          </button>
        </div>

        <button class="create-btn" @click="createNewFaq">
          <i class="fas fa-plus"></i>
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
                  <button class="action-btn view-btn">
                    <i class="fas fa-eye"></i>
                  </button>
                  <button class="action-btn edit-btn">
                    <i class="fas fa-edit"></i>
                  </button>
                  <button class="action-btn delete-btn">
                    <i class="fas fa-trash"></i>
                  </button>
                </td>
              </tr>
            </template>
            <tr v-else>
              <td colspan="4" class="py-4 text-center text-gray-500">
                Keine Fragen gefunden.
              </td>
            </tr>
          </tbody>
          
        </table>
      </div>

      <!-- ✅ Pagination -->
     <Pagination :links="props.faqs.links" />
    </div>
  </div>
</template>

<script setup>
import NavWelcome from '@/components/NavWelcome.vue';
import Pagination from '@/components/Pagination.vue';
import { computed, ref } from 'vue';

const props = defineProps({
  faqs: {
    type: Object, // because it's paginated
    required: true,
  },
});


const searchQuery = ref('');

const filteredFaqs = computed(() => {
  if (!searchQuery.value) return props.faqs.data;
  return props.faqs.data.filter(
    (faq) =>
      faq.question.toLowerCase().includes(searchQuery.value.toLowerCase()) ||
      faq.category?.name?.toLowerCase().includes(searchQuery.value.toLowerCase())
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
  console.log('Neue FAQ erstellen');
};
</script>

<style scoped>
/* Optional styling here */
</style>
