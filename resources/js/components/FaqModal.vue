<template>
  <div v-if="show" class="modal-overlay" @click="closeModal">
    <div class="modal-content" @click.stop>
      <div class="modal-header">
        <h2>{{ isEdit ? 'FAQ bearbeiten' : 'Neue FAQ erstellen' }}</h2>
        <button class="close-btn" @click="closeModal">
          <i class="fas fa-times"></i>
        </button>
      </div>

      <form @submit.prevent="submitForm" class="modal-body">
        <div class="form-group">
          <label for="question">Frage *</label>
          <input
            id="question"
            type="text"
            v-model="form.question"
            class="form-input"
            :class="{ 'error': errors.question }"
            placeholder="Geben Sie die Frage ein..."
            required
          />
          <span v-if="errors.question" class="error-message">{{ errors.question }}</span>
        </div>

        <div class="form-group">
          <label for="answer">Antwort *</label>
          <textarea
            id="answer"
            v-model="form.answer"
            class="form-textarea"
            :class="{ 'error': errors.answer }"
            placeholder="Geben Sie die Antwort ein..."
            rows="5"
            required
          ></textarea>
          <span v-if="errors.answer" class="error-message">{{ errors.answer }}</span>
        </div>

        <!-- Category and Tags in same line -->
        <div class="form-row">
          <div class="form-group form-group-half">
            <label for="category">Kategorie</label>
            <select
              id="category"
              v-model="form.category_id"
              class="form-select"
              :class="{ 'error': errors.category_id }"
            >
              <option value="">Kategorie auswählen</option>
              <option v-for="category in categories" :key="category.id" :value="category.id">
                {{ category.name }}
              </option>
            </select>
            <span v-if="errors.category_id" class="error-message">{{ errors.category_id }}</span>
          </div>

          <div class="form-group form-group-half">
            <label for="tags">Tags</label>
            <select
              id="tags"
              v-model="selectedTagId"
              class="form-select"
              :class="{ 'error': errors.tag_ids }"
              @change="addTag"
            >
              <option value="">Tag auswählen</option>
              <option 
                v-for="tag in availableTags" 
                :key="tag.id" 
                :value="tag.id"
              >
                {{ tag.name }}
              </option>
            </select>
            <span v-if="errors.tag_ids" class="error-message">{{ errors.tag_ids }}</span>
            
            <!-- Selected tags display -->
            <div v-if="form.tag_ids.length > 0" class="selected-tags">
              <span 
                v-for="tag in selectedTags" 
                :key="tag.id" 
                class="tag-pill"
              >
                {{ tag.name }}
                <button type="button" @click="removeTag(tag.id)" class="tag-remove">
                  ×
                </button>
              </span>
            </div>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" @click="closeModal">
                 <img class="search-icon" src="/assets/icons/icon-remove.svg" alt="search" />
            Abbrechen
          </button>
          <button type="submit" class="btn btn-primary" :disabled="processing">
            {{ processing ? 'Wird gespeichert...' : (isEdit ? 'Aktualisieren' : 'Speichern') }}
          </button>
        </div>
      </form>
    </div>
  </div>
</template>

<script setup>
import { ref, watch, computed } from 'vue';
import { useForm } from '@inertiajs/vue3';

const props = defineProps({
  show: {
    type: Boolean,
    default: false
  },
  faq: {
    type: Object,
    default: null
  },
  categories: {
    type: Array,
    default: () => []
  },
  tags: {
    type: Array,
    default: () => []
  }
});

const emit = defineEmits(['close', 'success']);

const form = useForm({
  question: '',
  answer: '',
  category_id: '',
  tag_ids: [],
});

const errors = ref({});
const processing = ref(false);
const selectedTagId = ref('');

const isEdit = computed(() => props.faq !== null);

// Get available tags (excluding already selected ones)
const availableTags = computed(() => {
  return props.tags.filter(tag => !form.tag_ids.includes(tag.id));
});

// Get selected tag objects
const selectedTags = computed(() => {
  return props.tags.filter(tag => form.tag_ids.includes(tag.id));
});

const addTag = () => {
  if (selectedTagId.value && !form.tag_ids.includes(selectedTagId.value)) {
    form.tag_ids.push(parseInt(selectedTagId.value));
    selectedTagId.value = '';
  }
};

const removeTag = (tagId) => {
  const index = form.tag_ids.indexOf(tagId);
  if (index > -1) {
    form.tag_ids.splice(index, 1);
  }
};

// Define resetForm function first
const resetForm = () => {
  form.reset();
  form.tag_ids = [];
  selectedTagId.value = '';
  errors.value = {};
};

// Watch for prop changes to populate form
watch(() => props.faq, (newFaq) => {
  if (newFaq) {
    form.question = newFaq.question || '';
    form.answer = newFaq.answer || '';
    form.category_id = newFaq.category_id || '';
    form.tag_ids = newFaq.tags ? newFaq.tags.map(tag => tag.id) : [];
  } else {
    resetForm();
  }
}, { immediate: true });

const closeModal = () => {
  resetForm();
  emit('close');
};

const submitForm = () => {
  processing.value = true;
  errors.value = {};

  const url = isEdit.value ? `/faqs/${props.faq.id}` : '/faqs';
  const method = isEdit.value ? 'put' : 'post';

  form[method](url, {
    onSuccess: () => {
      processing.value = false;
      emit('success');
      closeModal();
    },
    onError: (formErrors) => {
      processing.value = false;
      errors.value = formErrors;
    }
  });
};
</script>

<style scoped>
.modal-overlay {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: rgba(0, 0, 0, 0.5);
  display: flex;
  justify-content: center;
  align-items: center;
  z-index: 1000;
}

.modal-content {
  background: white;
  border-radius: 8px;
  width: 90%;
  max-width: 600px;
  max-height: 90vh;
  overflow-y: auto;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.modal-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 20px;
  border-bottom: 1px solid #e5e7eb;
}

.modal-header h2 {
  margin: 0;
  color: green;
}

.close-btn {
  background: none;
  border: none;
  font-size: 18px;
  cursor: pointer;
  color: #3d1000;
  padding: 4px;

}

.close-btn:hover {
  color: #374151;
}

.modal-body {
  padding: 20px;
}

.form-group {
  margin-bottom: 20px;
}

/* New styles for side-by-side layout */
.form-row {
  display: flex;
  gap: 15px;
  margin-bottom: 20px;
}

.form-group-half {
  flex: 1;
  margin-bottom: 0;
}

.form-group label {
  display: block;
  margin-bottom: 5px;
  font-weight: 500;
  color: #374151;
}

.form-input,
.form-textarea,
.form-select {
  width: 100%;
  padding: 8px 12px;
  border: 1px solid #d1d5db;
  border-radius: 4px;
  font-size: 14px;
  transition: border-color 0.15s ease-in-out;
}

.form-input:focus,
.form-textarea:focus,
.form-select:focus {
  outline: none;
  border-color: green;
  box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
}

.form-input.error,
.form-textarea.error,
.form-select.error {
  border-color: #d10000;
}

.form-textarea {
  resize: vertical;
  min-height: 100px;
}

/* Selected tags styles */
.selected-tags {
  margin-top: 8px;
  display: flex;
  flex-wrap: wrap;
  gap: 6px;
}

.tag-pill {
  display: inline-flex;
  align-items: center;
  background-color: #006b52;
  color: white;
  padding: 4px 8px;
  border-radius: 16px;
  font-size: 12px;
  font-weight: 500;
}

.tag-remove {
  background: none;
  border: none;
  color: white;
  margin-left: 4px;
  cursor: pointer;
  font-size: 14px;
  font-weight: bold;
  padding: 0;
  width: 16px;
  height: 16px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
}

.tag-remove:hover {
  background-color: rgba(255, 255, 255, 0.2);
}

.error-message {
  color: #d10000;
  font-size: 12px;
  margin-top: 4px;
  display: block;
}

.modal-footer {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding-top: 20px;
  border-top: 1px solid #e5e7eb;
}

.btn {
  padding: 8px 16px;
  border: none;
  border-radius: 4px;
  font-size: 14px;
  cursor: pointer;
  transition: background-color 0.15s ease-in-out;
}

.btn-secondary {
  background-color: #d10000;
  color: white;
  display: flex;
}



.btn-primary {
  background-color: #006b52;
  color: #b0fd78;
}


</style>