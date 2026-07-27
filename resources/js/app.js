import Alpine from 'alpinejs';

window.Alpine = Alpine;

/**
 * Shared factory for AJAX-managed image galleries (used by both the product
 * and showroom admin edit forms). Handles add + remove without a page reload
 * and without relying on a nested <form> element (which is invalid HTML and
 * previously corrupted the parent edit form's submission).
 *
 * @param {number} id            The owning record's ID (product/showroom).
 * @param {Array}  initialImages Array of { id, url } already saved.
 * @param {string} uploadUrl     POST endpoint to upload new image(s).
 * @param {string} deleteBaseUrl Base DELETE endpoint, image ID is appended.
 * @param {string} fieldName     Multipart field name expected by the backend
 *                               ("images" for products, "gallery" for showrooms).
 */
function mediaGallery(id, initialImages, uploadUrl, deleteBaseUrl, fieldName) {
    return {
        images: initialImages ?? [],
        loading: false,
        error: null,
        csrfToken: document.querySelector('meta[name="csrf-token"]')?.getAttribute('content'),

        async uploadImages(event) {
            const files = event.target.files;
            if (!files || !files.length) return;

            this.loading = true;
            this.error = null;

            const formData = new FormData();
            for (const file of files) {
                formData.append(`${fieldName}[]`, file);
            }

            try {
                const res = await fetch(uploadUrl, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': this.csrfToken,
                        Accept: 'application/json',
                    },
                    body: formData,
                });

                if (!res.ok) throw new Error('Upload failed');

                const data = await res.json();
                this.images.push(...data.images);
                event.target.value = '';
            } catch (e) {
                this.error = 'Gagal mengunggah gambar. Silakan coba lagi.';
            } finally {
                this.loading = false;
            }
        },

        async removeImage(imageId) {
            if (!window.confirm('Hapus gambar ini?')) return;

            this.loading = true;
            this.error = null;

            try {
                const res = await fetch(`${deleteBaseUrl}/${imageId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': this.csrfToken,
                        Accept: 'application/json',
                    },
                });

                if (!res.ok) throw new Error('Delete failed');

                this.images = this.images.filter((img) => img.id !== imageId);
            } catch (e) {
                this.error = 'Gagal menghapus gambar. Silakan coba lagi.';
            } finally {
                this.loading = false;
            }
        },
    };
}

document.addEventListener('alpine:init', () => {
    Alpine.data('productGallery', (id, initialImages, uploadUrl, deleteBaseUrl) =>
        mediaGallery(id, initialImages, uploadUrl, deleteBaseUrl, 'images')
    );

    Alpine.data('showroomGallery', (id, initialImages, uploadUrl, deleteBaseUrl) =>
        mediaGallery(id, initialImages, uploadUrl, deleteBaseUrl, 'gallery')
    );
});

Alpine.start();
