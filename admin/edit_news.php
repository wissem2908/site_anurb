<?php include "includes/header.php"; ?>
<!-- Begin Page Content -->

<style>
    .ck-editor__editable {
        min-height: 400px !important;
    }
</style>
<div class="container-fluid">

    <!-- Page Heading -->
    <!-- <h1 class="h3 mb-4 text-gray-800">Blank Page</h1> -->

    <div class="card shadow mb-4" id="add_news_card">



        <div class="card shadow-sm">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Modifier l'actualité</h6>
            </div>
            <div class="card-body">
                <form action="add_news.php" method="POST" enctype="multipart/form-data">
                    <div class="row g-3">
                        <!-- Title -->

                        <input type="hidden" value="<?php echo $_GET['id']; ?>" id="news_id" />
                        <div class="col-md-6">
                            <label for="title" class="form-label">Titre</label>
                            <input type="text" class="form-control" id="title" name="title" placeholder="Titre de la news" required>
                        </div>
                        <div class="col-md-6">
                            <label for="categories" class="form-label">Catégorie</label>
                            <select class="form-control" id="categories" name="categories" required>
                                <option value="" disabled>Choisir une catégorie</option>

                            </select>
                        </div>
                        <!-- Slug -->
                        <!-- <div class="col-md-6">
                        <label for="slug" class="form-label">Slug</label>
                        <input type="text" class="form-control" id="slug" name="slug" placeholder="slug-pour-url" required>
                         </div> -->

                        <!-- Description -->
                        <div class="col-12">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="5" placeholder="Contenu de la news" required></textarea>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">Tags</label>

                            <div class="tag-input" id="tagInput">
                                <input
                                    type="text"
                                    id="tagText"
                                    placeholder="Ajouter un tag puis Entrée ou virgule">
                            </div>

                            <!-- Hidden input sent to PHP -->
                            <input type="hidden" name="tags" id="tags">

                            <small class="text-muted">
                                Appuyez sur Entrée ou virgule pour ajouter un tag
                            </small>
                        </div>

                        <style>
                            .tag-input {
                                display: flex;
                                flex-wrap: wrap;
                                gap: 6px;
                                padding: 6px;
                                border: 1px solid #ced4da;
                                border-radius: 6px;
                                min-height: 42px;
                            }

                            .tag-input input {
                                border: none;
                                outline: none;
                                flex: 1;
                            }

                            .tag {
                                background: #0d6efd;
                                color: #fff;
                                padding: 4px 10px;
                                border-radius: 12px;
                                font-size: 13px;
                                display: flex;
                                align-items: center;
                                gap: 6px;
                            }

                            .tag span {
                                cursor: pointer;
                                font-weight: bold;
                            }
                        </style>
                        <!-- Featured & Status -->
                        <div class="col-md-6 d-flex align-items-center">
                            <div class="form-check mt-2">
                                <input class="form-check-input" type="checkbox" id="featured" name="featured">
                                <label class="form-check-label" for="featured">À la une</label>
                            </div>
                        </div>
                        <!-- <div class="col-md-6">
                            <label for="status" class="form-label">Statut</label>
                            <select class="form-control" id="status" name="status" required>
                                <option value="Brouillon">Brouillon</option>
                                <option value="Publié">Publié</option>
                                <option value="Archivé">Archivé</option>
                            </select>
                        </div> -->


                        <div class="col-md-6">
                            <label for="status" class="form-label">Statut</label>
                            <select class="form-control" id="status" name="status" required>
                                <option value="Brouillon">Brouillon</option>
                                <option value="Publié">Publié</option>
                                <option value="Archivé">Archivé</option>
                            </select>
                        </div>


                        <!-- Author & Category -->
                        <!-- <div class="col-md-6">
                        <label for="author_id" class="form-label">Auteur</label>
                        <select class="form-select" id="author_id" name="author_id" required>
                            <option value="" disabled selected>Choisir un auteur</option>
                            <option value="1">Auteur 1</option>
                            <option value="2">Auteur 2</option>
                        </select>
                    </div> -->


                        <!-- Published Date -->
                        <div class="col-md-6">
                            <label for="published_at" class="form-label">Date de Publication</label>
                            <input type="datetime-local" class="form-control" id="published_at" name="published_at" required>
                        </div>

                        <!-- Main Image -->
                        <div class="col-md-6">
                            <label for="main_image" class="form-label">Image Principale</label>
                            <input class="form-control" type="file" id="main_image" name="main_image" accept="image/*" required>
                        </div>
                        <div class="col-md-12 mt-2">
                            <img id="mainImagePreview" src="" alt="Preview" style="max-width: 100%; display: none; border: 1px solid #ccc; padding: 5px;">
                            <style>
                                #mainImagePreview {
                                    max-height: 250px;
                                    /* Limit the height */
                                    width: auto;
                                    /* Maintain aspect ratio */
                                    display: none;
                                    /* Hide until image is selected */
                                    border: 1px solid #ccc;
                                    /* Optional border */
                                    padding: 5px;
                                    /* Optional padding */
                                    border-radius: 4px;
                                    /* Optional rounded corners */
                                    object-fit: contain;
                                    /* Ensures the image fits inside the box without cropping */
                                }
                            </style>
                        </div>
                        <div class="col-md-12">
                            <div class="card shadow-sm mt-4">
                                <div class="card-body">
                                    <h5 class="card-title mb-3">Ajouter des Images pour l'actualité</h5>

                                    <div id="imageContainer" class="d-flex flex-wrap gap-3">
                                        <!-- Dynamic image cards will appear here -->
                                    </div>

                                    <button type="button" id="addImageBtn" class="btn btn-success mt-3">
                                        <i class="bi bi-plus-lg"></i> Ajouter une image
                                    </button>
                                    <small class="text-muted d-block mt-2">Vous pouvez réorganiser les images par glisser-déposer.</small>
                                </div>
                            </div>

                        </div>
                        <!-- Submit Button -->
                        <div class="col-12  mt-3">
                            <button type="submit" class="btn btn-primary btn-lg px-5" id="edit_news">Modifier l'actualité</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

<?php include "includes/footer.php"; ?>



<script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.15.6/Sortable.min.js" integrity="sha512-csIng5zcB+XpulRUa+ev1zKo7zRNGpEaVfNB9On1no9KYTEY/rLGAEEpvgdw6nim1WdTuihZY1eqZ31K7/fZjw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<!-- 2️⃣ Your JS -->
<script>
    /***************************************** add image html , remove , change position ****************************************** */
    document.addEventListener('DOMContentLoaded', function() {

        function fetchCategories() {
            $.ajax({
                url: 'assets/php/actualites/fetch_categories.php',
                method: 'POST',
                success: function(response) {
                    var data = JSON.parse(response);
                    var categoryOptions = '<option value="" disabled >Choisir une catégorie</option>';
                    for (i = 0; i < data.length; i++) {
                        categoryOptions += '<option value="' + data[i].id_category + '">' + data[i].category_name + '</option>';
                    }
                    $('#categories').html(categoryOptions);
                }
            });
        }
        fetchCategories()


        $('#main_image').on('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    $('#mainImagePreview').attr('src', e.target.result).show();
                }
                reader.readAsDataURL(file);
            } else {
                // No file selected, hide preview
                $('#mainImagePreview').hide().attr('src', '');
            }
        });


        let imageCount = 0;
        const container = document.getElementById('imageContainer');

        document.getElementById('addImageBtn').addEventListener('click', function() {
            imageCount++;
            const card = document.createElement('div');
            card.classList.add('image-card', 'card', 'p-2', 'shadow-sm');
            card.style.width = '180px';
            card.style.cursor = 'grab';
            card.setAttribute('data-position', imageCount);

            card.innerHTML = `
            <div class="mb-2">
                <label class="form-label">Image ${imageCount}</label>
                <input type="file" name="images[]" class="form-control image-input" accept="image/*" required>
            </div>
            <img src="" class="img-preview img-fluid rounded mb-2" style="display:none; max-height:150px;">
            <button type="button" class="btn btn-danger btn-sm remove-image-btn">Supprimer</button>
         `;

            container.appendChild(card);

            // Preview
            const fileInput = card.querySelector('.image-input');
            const imgPreview = card.querySelector('.img-preview');
            fileInput.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    imgPreview.src = URL.createObjectURL(file);
                    imgPreview.style.display = 'block';
                }
            });

            // Remove
            card.querySelector('.remove-image-btn').addEventListener('click', function() {
                card.remove();
                updatePositions();
            });

            updatePositions();
        });

        // Initialize SortableJS
        new Sortable(container, {
            animation: 150,
            ghostClass: 'sortable-ghost',
            onEnd: function() {
                updatePositions();
            }
        });

        function updatePositions() {
            const images = container.querySelectorAll('.image-card');
            images.forEach((img, index) => {
                img.setAttribute('data-position', index + 1);

                let hiddenInput = img.querySelector('input[name="positions[]"]');
                if (!hiddenInput) {
                    hiddenInput = document.createElement('input');
                    hiddenInput.type = 'hidden';
                    hiddenInput.name = 'positions[]';
                    img.appendChild(hiddenInput);
                }
                hiddenInput.value = index + 1;
            });
        }


        /******************************************************************************************** */
        let tags = [];

        const tagInput = document.getElementById('tagText');
        const tagContainer = document.getElementById('tagInput');
        const hiddenTags = document.getElementById('tags');

        tagInput.addEventListener('keydown', function(e) {

            if (e.key === 'Enter' || e.key === ',') {
                e.preventDefault();

                let value = tagInput.value.trim().replace(',', '');
                if (value === '') return;

                value = value.toLowerCase();

                if (!tags.includes(value)) {
                    tags.push(value);
                    renderTags();
                }

                tagInput.value = '';
            }
        });

        function renderTags() {
            tagContainer.querySelectorAll('.tag').forEach(t => t.remove());

            tags.forEach((tag, index) => {
                const el = document.createElement('div');
                el.className = 'tag';
                el.innerHTML = `${tag} <span data-index="${index}">&times;</span>`;
                tagContainer.insertBefore(el, tagInput);
            });

            hiddenTags.value = tags.join(',');
        }

        tagContainer.addEventListener('click', function(e) {
            if (e.target.tagName === 'SPAN') {
                tags.splice(e.target.dataset.index, 1);
                renderTags();
            }
        });

        /***********************************************************************************************/
        function getDataNews() {

            var news_id = $('#news_id').val()
            $.ajax({
                url: 'assets/php/actualites/get_news_by_id.php',
                method: "POST",
                data: {
                    id: news_id
                },
                success: function(response) {

                    var data = JSON.parse(response);
                    console.log(data)

                    $('#title').val(data.title)

                    console.log(data.category_id)

                    $('#categories').val(data.category_id)

                    //  $('#description').val(data.description)
                    descriptionEditor.setData(data.description);
                    $('#featured').prop('checked', data.featured == 1);
                    $('#status').val(data.status)
                    $('#published_at').val(data.published_at)

                    $('#mainImagePreview').attr('src', 'assets/uploads/news/' + data.main_image)
                    $('#mainImagePreview').css('display', 'block')



                    /********************** ** get tags *************************/
                    $.ajax({
                        url: 'assets/php/actualites/get_news_tags.php',
                        method: 'POST',
                        data: {
                            id: news_id
                        },
                        success: function(response) {
                            console.log(response)
                            var dataTags = JSON.parse(response)

                            tags = []; // reset if needed

                            dataTags.forEach(tag => {
                                let value = tag.name.trim().toLowerCase();

                                if (value !== '' && !tags.includes(value)) {
                                    tags.push(value);
                                }
                            });

                            renderTags();


                        }
                    })

                    /****************************get images *************************** */

                    $.ajax({
                        url: 'assets/php/actualites/get_news_images.php',
                        method: 'POST',
                        data: {
                            id: news_id
                        },
                        success: function(response) {
                            const dataImages = JSON.parse(response); // your backend data

                            // Reset imageCount if needed
                            imageCount = 0;

                            dataImages.forEach(img => {
                                imageCount++;
                                const card = document.createElement('div');
                                card.classList.add('image-card', 'card', 'p-2', 'shadow-sm');
                                card.style.width = '180px';
                                card.style.cursor = 'grab';
                                card.setAttribute('data-position', img.position);

                                card.innerHTML = `
                                    <div class="mb-2">
                                        <label class="form-label">Image ${imageCount}</label>
                                        <input type="file" name="images[]" class="form-control image-input" accept="image/*">
                                    </div>
                                    <img src="assets/uploads/news/${img.image}" class="img-preview img-fluid rounded mb-2" style="display:block; max-height:150px;">
                                    <button type="button" class="btn btn-danger btn-sm remove-image-btn">Supprimer</button>
                                `;

                                container.appendChild(card);

                                // Preview for new upload
                                const fileInput = card.querySelector('.image-input');
                                const imgPreview = card.querySelector('.img-preview');
                                fileInput.addEventListener('change', function(e) {
                                    const file = e.target.files[0];
                                    if (file) {
                                        imgPreview.src = URL.createObjectURL(file);
                                        imgPreview.style.display = 'block';
                                    }
                                });

                                // Remove button
                                card.querySelector('.remove-image-btn').addEventListener('click', function() {
                                    card.remove();
                                    updatePositions();
                                });

                                // Hidden input for position
                                let hiddenInput = document.createElement('input');
                                hiddenInput.type = 'hidden';
                                hiddenInput.name = 'positions[]';
                                hiddenInput.value = img.position;
                                card.appendChild(hiddenInput);
                            });

                            // Update positions after loading backend images
                            updatePositions();
                        }
                    });

                }
            })
        }
        getDataNews()

    });


    /******************************* UPDATE NEWS **************************************** */

    $('#edit_news').on('click', function(e) {
        e.preventDefault();

        let form = $('form')[0];
        let formData = new FormData(form);
        var title = $('#title').val();
        var category = $('#categories').val();
        var status = $('#status').val();
        var published_at = $('#published_at').val();
        formData.append('tags', $('#tags').val());
        formData.append('id', $('#news_id').val());
        const description = descriptionEditor.getData().trim();
        var published_at = $('#published_at').val();
        var main_image = $('#main_image')[0].files[0];
        formData.append('title', title);
        formData.append('category', category);
        formData.append('description', description);
        // formData.append('featured', featured);
        formData.append('status', status);
        formData.append('published_at', published_at);
        formData.append('main_image', main_image);
        // checkbox fix
        formData.set('featured', $('#featured').is(':checked') ? 1 : 0);
   $('.image-card').each(function() {
                var imageFile = $(this).find('.image-input')[0].files[0];
                var position = $(this).data('position');
                formData.append('images[]', imageFile);
                formData.append('positions[]', position);
            });
        $.ajax({
            url: 'assets/php/actualites/update_news.php',
            method: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(res) {
                let data = JSON.parse(res);

                if (data.success) {
                    alert('Actualité mise à jour avec succès');
                    window.location.reload();
                } else {
                    alert(data.error);
                }
            },
            error: function() {
                alert('Erreur serveur lors de la mise à jour');
            }
        });
    });
</script>

<script>
    ClassicEditor
        .create(document.querySelector('#description'), {
            toolbar: {
                items: [
                    'heading', '|', 'bold', 'italic', 'underline', 'strikethrough',
                    '|', 'link', 'bulletedList', 'numberedList', '|', 'undo', 'redo'
                ]
            }
        })
        .then(editor => {
            descriptionEditor = editor;
            editor.ui.view.editable.element.style.minHeight = '400px';
        })
        .catch(error => {
            console.error(error);
        });
</script>