<template>
  <div v-if="show" class="modal-overlay" @click="handleOverlayClick">
    <div class="modal-container" @click.stop>
      <div class="modal-header">
        <h3>{{ title || 'Bestätigung erforderlich' }}</h3>
        <button class="close-btn" @click="$emit('close')">
          <i class="fas fa-times"></i>
        </button>
      </div>
      
      <div class="modal-body">
        <div class="warning-icon">
          <i class="fas fa-exclamation-triangle"></i>
        </div>
        <p>{{ message || 'Sind Sie sicher, dass Sie diese Aktion durchführen möchten?' }}</p>
        <p v-if="description" class="description">{{ description }}</p>
      </div>
      
      <div class="modal-footer">
        <button class="btn btn-cancel" @click="$emit('close')">
          Abbrechen
        </button>
        <button class="btn btn-delete" @click="handleConfirm" :disabled="loading">
          <i v-if="loading" class="fas fa-spinner fa-spin"></i>
          {{ loading ? 'Wird gelöscht...' : 'Löschen' }}
        </button>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue';

const props = defineProps({
  show: {
    type: Boolean,
    default: false
  },
  title: {
    type: String,
    default: 'Bestätigung erforderlich'
  },
  message: {
    type: String,
    default: 'Sind Sie sicher, dass Sie diese Aktion durchführen möchten?'
  },
  description: {
    type: String,
    default: ''
  }
});

const emit = defineEmits(['close', 'confirm']);

const loading = ref(false);

const handleOverlayClick = () => {
  if (!loading.value) {
    emit('close');
  }
};

const handleConfirm = async () => {
  loading.value = true;
  try {
    await emit('confirm');
  } finally {
    loading.value = false;
  }
};
</script>

<style scoped>
.modal-overlay {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5);
  display: flex;
  justify-content: center;
  align-items: center;
  z-index: 1000;
}

.modal-container {
  background: white;
  border-radius: 8px;
  box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
  max-width: 500px;
  width: 90%;
  max-height: 90vh;
  overflow-y: auto;
}

.modal-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 1.5rem;
  border-bottom: 1px solid #e5e7eb;
}

.modal-header h3 {
  margin: 0;
  color: #d10000;
  font-weight: 600;
}

.close-btn {
  background: none;
  border: none;
  font-size: 1.2rem;
  cursor: pointer;
  color: #696969;
  padding: 0.25rem;
  border-radius: 4px;
  transition: color 0.2s;
}



.modal-body {
  padding: 2rem 1.5rem;
  text-align: center;
}

.warning-icon {
  margin-bottom: 1rem;
}

.warning-icon i {
  font-size: 3rem;
  color: #f59e0b;
}

.modal-body p {
  margin: 0 0 1rem 0;
  color: #006b52;
  font-size: 1.1rem;
  font-weight: 500;
}

.description {
  color: #006b52 !important;
  font-size: 0.9rem !important;
  font-weight: 400 !important;
}

.modal-footer {
  display: flex;
  justify-content: space-between;
  gap: 0.75rem;
  padding: 1.5rem;
  border-top: 1px solid #e5e7eb;
  background-color: #f9fafb;
}

.btn {
  padding: 0.75rem 1.5rem;
  border: none;
  border-radius: 6px;
  font-weight: 500;
  cursor: pointer;
  transition: all 0.2s;
  display: flex;
  align-items: center;
  gap: 0.5rem;
}

.btn:disabled {
  opacity: 0.6;
  cursor: not-allowed;
}

.btn-cancel {
  background-color: #696969;
  color: #ffffff;
  border: 1px solid #696969;
}



.btn-delete {
  background-color: #d10000;
  color: white;
}


.fa-spin {
  animation: fa-spin 1s infinite linear;
}

@keyframes fa-spin {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(360deg);
  }
}
</style>