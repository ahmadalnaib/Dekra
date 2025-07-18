<template>
    <div>
        <NavWelcome />
        <div class="showcase-content">
            <h1>Häufig gestellte Fragen</h1>
            <p>Willkommen in unserem Hilfe-Center. Hier finden Sie eine Sammlung der häufigsten Fragen und Antworten zu unseren Services.</p>
            
          
         
        </div>

        <!-- New FAQ Management Section -->
        <div class="faq-management-section">
            <!-- Question Count and Search Section -->
            <div class="controls-section">
                <div class="count-section">
                    <h3>Insgesamt {{ filteredFaqs.length }} von {{ faqs.length }} Fragen</h3>
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
                        <tr v-for="faq in filteredFaqs" :key="faq.id">
                            <td>{{ faq.question }}</td>
                            <td>
                                <span class="category-badge" :class="getCategoryClass(faq.category)">
                                    {{ faq.category }}
                                </span>
                            </td>
                            <td>{{ formatDate(faq.created_at) }}</td>
                            <td class="actions">
                                <button class="action-btn view-btn" @click="viewFaq(faq.id)">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="action-btn edit-btn" @click="editFaq(faq.id)">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="action-btn delete-btn" @click="deleteFaq(faq.id)">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        
    </div>
</template>

<script setup>
import NavWelcome from '@/components/NavWelcome.vue';
import { ref, computed } from 'vue';

const searchQuery = ref('');
const faqs = ref([
    {
        id: 1,
        question: 'Wie kann ich mein Passwort zurücksetzen?',
        category: 'Account',
        created_at: '2024-01-15T10:30:00Z'
    },
    {
        id: 2,
        question: 'Welche Zahlungsmethoden akzeptieren Sie?',
        category: 'Zahlung',
        created_at: '2024-01-10T14:20:00Z'
    },
    {
        id: 3,
        question: 'Wie lange dauert die Bearbeitung?',
        category: 'Service',
        created_at: '2024-01-08T09:15:00Z'
    }
]);

const filteredFaqs = computed(() => {
    if (!searchQuery.value) return faqs.value;
    return faqs.value.filter(faq => 
        faq.question.toLowerCase().includes(searchQuery.value.toLowerCase()) ||
        faq.category.toLowerCase().includes(searchQuery.value.toLowerCase())
    );
});

const performSearch = () => {
    console.log('Searching for:', searchQuery.value);
    
};

const createNewFaq = () => {
    router.push('/faq/create');
};

const viewFaq = (id) => {
    router.push(`/faq/${id}`);
};

const editFaq = (id) => {
    router.push(`/faq/${id}/edit`);
};

const deleteFaq = (id) => {
    if (confirm('Sind Sie sicher, dass Sie diese FAQ löschen möchten?')) {
        faqs.value = faqs.value.filter(faq => faq.id !== id);
    }
};

const formatDate = (dateString) => {
    return new Date(dateString).toLocaleDateString('de-DE');
};

const getCategoryClass = (category) => {
    const categoryMap = {
        'Account': 'category-account',
        'Zahlung': 'category-payment',
        'Service': 'category-service'
    };
    return categoryMap[category] || 'category-default';
};
</script>

<style scoped>
.faq-management-section {
    padding: 20px;
    max-width: 1200px;
    margin: 0 auto;
}

.controls-section {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin: 30px 0;
    gap: 20px;
}

.count-section {
    flex-shrink: 0;
}

.count-section h3 {
    color: #28a745;
    font-weight: 600;
    margin: 0;
    white-space: nowrap;
}

.search-box {
    display: flex;
    flex: 1;
    max-width: 500px;
    position: relative;
}

.search-input {
    flex: 1;
    padding: 12px 16px;
    border: 2px solid #e1e5e9;
    border-radius: 8px 0 0 8px;
    font-size: 14px;
    transition: border-color 0.3s ease;
    border-right: none;
}

.search-input:focus {
    outline: none;
    border-color: #28a745;
}

.search-btn {
    background: #28a745;
    color: white;
    border: none;
    padding: 12px 20px;
    border-radius: 0 8px 8px 0;
    cursor: pointer;
    font-size: 14px;
    font-weight: 500;
    display: flex;
    align-items: center;
    gap: 8px;
    transition: background-color 0.3s ease;
    white-space: nowrap;
    border: 2px solid #28a745;
}

.search-btn:hover {
    background: #218838;
    border-color: #218838;
}

.create-btn {
    background: #28a745;
    color: white;
    border: none;
    padding: 12px 20px;
    border-radius: 8px;
    cursor: pointer;
    font-size: 14px;
    font-weight: 500;
    display: flex;
    align-items: center;
    gap: 8px;
    transition: background-color 0.3s ease;
    flex-shrink: 0;
}

.create-btn:hover {
    background: #218838;
}

.table-container {
    background: #f8f9fa;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

.faq-table {
    width: 100%;
    border-collapse: collapse;
    background: #f8f9fa;
}

.faq-table th {
    background: #28a745;
    color: #d4edda;
    padding: 16px;
    text-align: left;
    font-weight: 600;
    border-bottom: 1px solid #dee2e6;
}

.faq-table td {
    padding: 16px;
    border-bottom: 1px solid #dee2e6;
    vertical-align: middle;
    color: #000;
    background: #f8f9fa;
}

.faq-table tbody tr:hover {
    background: #e9ecef;
}

.category-badge {
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 500;
    text-transform: uppercase;
}

.category-account {
    background: #e3f2fd;
    color: #1976d2;
}

.category-payment {
    background: #e8f5e8;
    color: #388e3c;
}

.category-service {
    background: #fff3e0;
    color: #f57c00;
}

.category-default {
    background: #f5f5f5;
    color: #666;
}

.actions {
    display: flex;
    gap: 8px;
}

.action-btn {
    padding: 8px;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    transition: all 0.3s ease;
    width: 36px;
    height: 36px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.view-btn {
    background: #e3f2fd;
    color: #1976d2;
}

.view-btn:hover {
    background: #bbdefb;
}

.edit-btn {
    background: #fff3e0;
    color: #f57c00;
}

.edit-btn:hover {
    background: #ffe0b2;
}

.delete-btn {
    background: #ffebee;
    color: #d32f2f;
}

.delete-btn:hover {
    background: #ffcdd2;
}

@media (max-width: 768px) {
    .controls-section {
        flex-direction: column;
        align-items: stretch;
    }
    
    .search-box {
        max-width: none;
    }
    
    .search-input {
        border-radius: 8px 0 0 8px;
    }
    
    .search-btn {
        border-radius: 0 8px 8px 0;
    }
    
    .faq-table {
        font-size: 14px;
    }
    
    .faq-table th,
    .faq-table td {
        padding: 12px 8px;
    }
}
</style>