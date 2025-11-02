import { customFetch } from '../custom.fetch.js';

const usersTable = document.getElementById('users-table');
const paginationContainer = document.getElementById('pagination');

async function loadUsers(page = 1) {
    const data = await customFetch(`/users?page=${page}`);

    if (data && data.data) {
        renderHeaders();
        renderTable(data.data);
        renderPagination(data);
    }
}

function renderHeaders() {
    const thead = usersTable.querySelector('thead');
    thead.innerHTML = `
        <tr class="bg-gray-100">
            <th class="p-2 border">Nombre</th>
            <th class="p-2 border">Email</th>
            <th class="p-2 border">Grupo</th>
            <th class="p-2 border">Rol</th>
            <th class="p-2 border">Cuota (MB)</th>
            <th class="p-2 border">Uso (MB)</th>
            <th class="p-2 border">Acciones</th>
        </tr>
    `;
}

function renderTable(users) {
    const tbody = usersTable.querySelector('tbody');

    tbody.innerHTML = users
        .map(user => `
            <tr>
                <td>${user.name}</td>
                <td>${user.email}</td>
                <td>${user.group.name}</td>
                <td>${user.role.name}</td>
                <td>${user.quota_limit_mb}</td>
                <td>${user.used_space_mb}</td>
            </tr>
        `)
        .join('');
}

function renderPagination(paginated) {
    paginationContainer.innerHTML = `
        <button ${!paginated.prev_page_url ? 'disabled' : ''} data-page="${paginated.current_page - 1}">Anterior</button>
        <span>Página ${paginated.current_page} de ${paginated.last_page}</span>
        <button ${!paginated.next_page_url ? 'disabled' : ''} data-page="${paginated.current_page + 1}">Siguiente</button>
    `;

    paginationContainer.querySelectorAll('button[data-page]').forEach(btn => {
        btn.addEventListener('click', () => {
            const page = parseInt(btn.dataset.page);
            if (!isNaN(page)) loadUsers(page);
        });
    });
}

document.addEventListener('DOMContentLoaded', () => loadUsers());
