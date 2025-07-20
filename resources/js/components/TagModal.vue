<template>
  <div v-if="show" class="modal-overlay" @click="closeModal">
    <div class="modal-content" @click.stop>
      <div class="modal-header">
        <h2>{{ isEdit ? 'Tag bearbeiten' : 'Neuen Tag erstellen' }}</h2>
        <button class="close-btn" @click="closeModal">
          <i class="fas fa-times"></i>
        </button>
      </div>

      <form @submit.prevent="submitForm" class="modal-body">
        <div class="form-group">
          <label for="name">Name *</label>
          <input
            id="name"
            type="text"
            v-model="form.name"
            class="form-input"
            :class="{ 'error': errors.name }"
            placeholder="Geben Sie den Namen ein..."
            required
          />
          <span v-if="errors.name" class="error-message">{{ errors.name }}</span>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" @click="closeModal">
            Abbrechen
          </button>
          <button type="submit" class="btn btn-primary" :disabled="processing">
            {{ processing ? 'Wird gespeichert...' : (isEdit ? 'Aktualisieren' : 'Erstellen') }}
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
  tag: {
    type: Object,
    default: null
  },
  tags: {
    type: Array,
    default: () => []
  }
});

const emit = defineEmits(['close', 'success']);

const form = useForm({
  name: '',
});

const errors = ref({});
const processing = ref(false);

const isEdit = computed(() => props.tag !== null);

// Define resetForm function
const resetForm = () => {
  form.reset();
  errors.value = {};
};

// Watch for prop changes to populate form
watch(() => props.tag, (newTag) => {
  if (newTag) {
    form.name = newTag.name || '';
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

  const url = isEdit.value ? `/tags/${props.tag.id}` : '/tags';
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
  color: red;
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

.form-group label {
  display: block;
  margin-bottom: 5px;
  font-weight: 500;
  color: #374151;
}

.form-input {
  width: 100%;
  padding: 8px 12px;
  border: 1px solid #d1d5db;
  border-radius: 4px;
  font-size: 14px;
  transition: border-color 0.15s ease-in-out;
  box-sizing: border-box;
}

.form-input:focus {
  outline: none;
  border-color: green;
  box-shadow: 0 0 0 3px rgba(0, 128, 0, 0.1);
}

.form-input.error {
  border-color: #d10000;
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
  gap: 10px;
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
}


.btn-primary {
  background-color: #006b52;
  color: #b0fd78;
}




</style>