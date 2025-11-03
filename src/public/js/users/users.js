import { customFetch } from '../custom.fetch.js';

const table = document.getElementById('users-table');
const tbody = table.querySelector('tbody');
const rowTemplate = document.getElementById('user-row-template');
const pagination = document.getElementById('pagination');
const userBaseUrl = '/users';

const modal = document.getElementById('delete-modal');
const userToDeleteSpan = document.getElementById('user-to-delete');
const cancelDeleteBtn = document.getElementById('cancel-delete');

const getDeleteForm = document.getElementById('delete-user');

let userToDelete = null;

async function loadUsers(page = 1) {
    const response = await customFetch(`/users/get?page=${page}`);
    if (response?.data) {
        renderTable(response.data);
        renderPagination(response);
    }
}

function renderTable(users) {
    tbody.querySelectorAll('tr:not(#user-row-template)').forEach(row => row.remove());

    users.forEach(user => {
        const row = rowTemplate.cloneNode(true);
        row.id = '';
        row.classList.remove('hidden');

        row.querySelector('.user-name').textContent = user.name;
        row.querySelector('.user-email').textContent = user.email;
        row.querySelector('.user-group').textContent = user.group?.name ?? '-';
        row.querySelector('.user-role').textContent = user.role?.name ?? '-';
        row.querySelector('.user-quota').textContent = user.quota_limit_mb ?? '-';
        row.querySelector('.user-used').textContent = user.used_space_mb ?? '-';

        const userEditLink = row.querySelector('.user-edit');
        const userDeleteLink = row.querySelector('.user-delete');

        if (userEditLink) {
            userEditLink.href = `${userBaseUrl}/${user.id}/edit`;
        }

        if (userDeleteLink) {
            userDeleteLink.addEventListener('click', (e) => {
                e.preventDefault();
                openDeleteModal(user);
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

function openDeleteModal(user) {
    userToDelete = user;
    userToDeleteSpan.textContent = user.name;
    getDeleteForm.action = `${userBaseUrl}/${user.id}`;
    modal.classList.remove('hidden');
}

function closeDeleteModal() {
    modal.classList.add('hidden');
    userToDelete = null;
}

cancelDeleteBtn.addEventListener('click', closeDeleteModal);

document.addEventListener('DOMContentLoaded', () => loadUsers());
