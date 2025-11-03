const dropzone = document.getElementById('dropzone');
const input = document.getElementById('file-input');
const listDesktop = document.getElementById('file-names');
const listMobile = document.getElementById('file-names-mobile');
const noFilesDesktop = document.getElementById('no-files');
const noFilesMobile = document.getElementById('no-files-mobile');

let selectedFiles = [];

function renderFiles() {
    listDesktop.innerHTML = '';
    listMobile.innerHTML = '';

    if (selectedFiles.length === 0) {
        noFilesDesktop.style.display = 'block';
        noFilesMobile.style.display = 'block';
        return;
    }

    noFilesDesktop.style.display = 'none';
    noFilesMobile.style.display = 'none';

    selectedFiles.forEach((file, index) => {
        const itemHTML = `
        <li class="flex justify-between items-center py-2">
          <div class="flex flex-col sm:flex-row sm:items-center gap-1 sm:gap-3">
            <span class="truncate max-w-[200px]">${file.name}</span>
            <span class="text-gray-500 text-xs">${(file.size / 1024).toFixed(1)} KB</span>
          </div>
          <button data-index="${index}" class="text-red-600 hover:text-red-800 text-sm font-medium delete-file">
            Eliminar
          </button>
        </li>
      `;
        listDesktop.insertAdjacentHTML('beforeend', itemHTML);
        listMobile.insertAdjacentHTML('beforeend', itemHTML);
    });

    document.querySelectorAll('.delete-file').forEach(btn => {
        btn.addEventListener('click', e => {
            const index = parseInt(e.target.dataset.index);
            selectedFiles.splice(index, 1);
            renderFiles();
        });
    });
}

dropzone.addEventListener('click', () => input.click());

input.addEventListener('change', (e) => {
    selectedFiles = [...selectedFiles, ...Array.from(e.target.files)];
    renderFiles();
});

dropzone.addEventListener('dragover', (e) => {
    e.preventDefault();
    dropzone.classList.add('bg-gray-100', 'border-blue-400');
});

dropzone.addEventListener('dragleave', () => {
    dropzone.classList.remove('bg-gray-100', 'border-blue-400');
});

dropzone.addEventListener('drop', (e) => {
    e.preventDefault();
    dropzone.classList.remove('bg-gray-100', 'border-blue-400');
    const files = Array.from(e.dataTransfer.files);
    selectedFiles = [...selectedFiles, ...files];
    renderFiles();
});