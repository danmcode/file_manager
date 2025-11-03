import { customFetch } from '../custom.fetch.js';

const table = document.getElementById('roles-table');
const tbody = table.querySelector('tbody');
const rowTemplate = document.getElementById('role-row-template');
const pagination = document.getElementById('pagination');
const roleBaseUrl = '/roles';

const modal = document.getElementById('delete-modal');
const roleToDeleteSpan = document.getElementById('role-to-delete');
const cancelDeleteBtn = document.getElementById('cancel-delete');

const getDeleteForm = document.getElementById('delete-role');

let roleToDelete = null;

async function loadUsers(page = 1) {
    const response = await customFetch(`/roles/get?page=${page}`);
    if (response?.data) {
        renderTable(response.data);
        renderPagination(response);
    }
}

function renderTable(roles) {
    tbody.querySelectorAll('tr:not(#role-row-template)').forEach(row => row.remove());

    roles.forEach(role => {
        const row = rowTemplate.cloneNode(true);
        row.id = '';
        row.classList.remove('hidden');

        row.querySelector('.role-name').textContent = role.name;
        row.querySelector('.role-description').textContent = role.description;

        const roleEditLink = row.querySelector('.role-edit');
        const roleDeleteLink = row.querySelector('.role-delete');

        if (roleEditLink) {
            roleEditLink.href = `${roleBaseUrl}/${role.id}/edit`;
        }

        if (roleDeleteLink) {
            roleDeleteLink.addEventListener('click', (e) => {
                e.preventDefault();
                openDeleteModal(role);
            });
        }

        tbody.appendChild(row);
    });
}

function renderPagination(paginated) {
    pagination.innerHTML = `
        <button ${!paginated.prev_page_url ? 'disabled' : ''} data-page="${paginated.current_page - 1}">
            Anterior
        </button>
        <span>Página ${paginated.current_page} de ${paginated.last_page}</span>
        <button ${!paginated.next_page_url ? 'disabled' : ''} data-page="${paginated.current_page + 1}">
            Siguiente
        </button>
    `;

    pagination.querySelectorAll('button[data-page]').forEach(btn => {
        btn.addEventListener('click', () => {
            const page = parseInt(btn.dataset.page);
            if (!isNaN(page)) loadUsers(page);
        });
    });
}

function openDeleteModal(role) {
    roleToDelete = role;
    roleToDeleteSpan.textContent = role.name;
    getDeleteForm.action = `${roleBaseUrl}/${role.id}`;
    modal.classList.remove('hidden');
}

function closeDeleteModal() {
    modal.classList.add('hidden');
    roleToDelete = null;
}

cancelDeleteBtn.addEventListener('click', closeDeleteModal);

document.addEventListener('DOMContentLoaded', () => loadUsers());
