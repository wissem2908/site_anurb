<?php include "includes/header.php"; ?>
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <!-- <h1 class="h3 mb-4 text-gray-800">Blank Page</h1> -->

                     <div class="card shadow mb-4" id="add_news_card" >



        <div class="card shadow-sm">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Modifier l'actualité</h6>
            </div>
            <div class="card-body">
                <form action="add_news.php" method="POST" enctype="multipart/form-data">
                    <div class="row g-3">
                        <!-- Title -->
                        <div class="col-md-6">
                            <label for="title" class="form-label">Titre</label>
                            <input type="text" class="form-control" id="title" name="title" placeholder="Titre de la news" required>
                        </div>
                        <div class="col-md-6">
                            <label for="categories" class="form-label">Catégorie</label>
                            <select class="form-control" id="categories" name="categories" required>
                                <option value="" disabled selected>Choisir une catégorie</option>

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
                                <input class="form-check-input" type="checkbox" id="featured" name="featured" value="1">
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
                            <button type="submit" class="btn btn-primary btn-lg px-5" id="add_news">Ajouter l'actualité</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

                </div>
                <!-- /.container-fluid -->

    <?php include "includes/footer.php"; ?>        



    <script>
        $(document).ready(function(){


    /************************************** get category **************************************/

    function fetchCategories() {
        $.ajax({
            url: 'assets/php/actualites/fetch_categories.php',
            method: 'POST',
            success: function(response) {
                var data = JSON.parse(response);
                var categoryOptions = '<option value="" disabled selected>Choisir une catégorie</option>';
                for (i = 0; i < data.length; i++) {
                    categoryOptions += '<option value="' + data[i].id_category + '">' + data[i].category_name + '</option>';
                }
                $('#categories').html(categoryOptions);
            }
        });
    }
    fetchCategories()


            
        })
    </script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.15.6/Sortable.min.js" integrity="sha512-csIng5zcB+XpulRUa+ev1zKo7zRNGpEaVfNB9On1no9KYTEY/rLGAEEpvgdw6nim1WdTuihZY1eqZ31K7/fZjw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<!-- 2️⃣ Your JS -->
<script>
    /***************************************** add image html , remove , change position ****************************************** */
    document.addEventListener('DOMContentLoaded', function() {
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

      
    });
</script>