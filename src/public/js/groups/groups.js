import { customFetch } from '../custom.fetch.js';

const table = document.getElementById('groups-table');
const tbody = table.querySelector('tbody');
const rowTemplate = document.getElementById('group-row-template');
const pagination = document.getElementById('pagination');
const groupBaseUrl = '/groups';

const modal = document.getElementById('delete-modal');
const groupToDeleteSpan = document.getElementById('group-to-delete');
const cancelDeleteBtn = document.getElementById('cancel-delete');

const getDeleteForm = document.getElementById('delete-group');
let groupToDelete = null;

async function loadUsers(page = 1) {
    const response = await customFetch(`/groups/get?page=${page}`);
    if (response?.data) {
        renderTable(response.data);
        renderPagination(response);
    }
}

function renderTable(groups) {
    tbody.querySelectorAll('tr:not(#group-row-template)').forEach(row => row.remove());

    groups.forEach(group => {
        const row = rowTemplate.cloneNode(true);
        row.id = '';
        row.classList.remove('hidden');

        row.querySelector('.group-name').textContent = group.name;
        row.querySelector('.group-description').textContent = group.description;

        const groupEditLink = row.querySelector('.group-edit');
        const groupDeleteLink = row.querySelector('.group-delete');

        if (groupEditLink) {
            groupEditLink.href = `${groupBaseUrl}/${group.id}/edit`;
        }

        if (groupDeleteLink) {
            groupDeleteLink.addEventListener('click', (e) => {
                e.preventDefault();
                openDeleteModal(group);
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

function openDeleteModal(group) {
    groupToDelete = group;
    groupToDeleteSpan.textContent = group.name;
    getDeleteForm.action = `${groupBaseUrl}/${group.id}`;
    modal.classList.remove('hidden');
}

function closeDeleteModal() {
    modal.classList.add('hidden');
    groupToDelete = null;
}

cancelDeleteBtn.addEventListener('click', closeDeleteModal);

document.addEventListener('DOMContentLoaded', () => loadUsers());
