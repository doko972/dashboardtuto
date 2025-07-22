    @section('styles')
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    @endsection
    <div class="row">
    <div class="col-md-8">
        <form action="{{ isset($video) ? route('admin.video.update', ['video' => $video->id]) : route('admin.video.store') }}" method="POST" >
        @csrf
        @if(isset($video))
            @method('PUT')
        @endif    <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text"  placeholder="Title ..."  name="title" value="{{ old('title', isset($video) ? $video->title : '') }}" class="form-control" id="title" aria-describedby="titleHelp" required/>

        @error('title')
            <div class="error text-danger">
                {{ $message }}
            </div>
        @enderror
    </div>    <div class="mb-3">
        <label for="url" class="form-label">Url</label>
        <input type="text"  placeholder="Url ..."  name="url" value="{{ old('url', isset($video) ? $video->url : '') }}" class="form-control" id="url" aria-describedby="urlHelp" required/>

        @error('url')
            <div class="error text-danger">
                {{ $message }}
            </div>
        @enderror
    </div>    <div class="mb-3">
        <label for="duration" class="form-label">Duration</label>
        <input type="text"  placeholder="Duration ..."  name="duration" value="{{ old('duration', isset($video) ? $video->duration : '') }}" class="form-control" id="duration" aria-describedby="durationHelp" required/>

        @error('duration')
            <div class="error text-danger">
                {{ $message }}
            </div>
        @enderror
    </div>    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <input type="text"  placeholder="Description ..."  name="description" value="{{ old('description', isset($video) ? $video->description : '') }}" class="form-control" id="description" aria-describedby="descriptionHelp" required/>

        @error('description')
            <div class="error text-danger">
                {{ $message }}
            </div>
        @enderror
    </div>    <div class="mb-3">
        <label for="role" class="form-label">Role</label>
        <input type="text"  placeholder="Role ..."  name="role" value="{{ old('role', isset($video) ? $video->role : '') }}" class="form-control" id="role" aria-describedby="roleHelp" required/>

        @error('role')
            <div class="error text-danger">
                {{ $message }}
            </div>
        @enderror
    </div>    <div class="mb-3">
        <label for="created_by" class="form-label">Created_by</label>
        <input type="text"  placeholder="Created_by ..."  name="created_by" value="{{ old('created_by', isset($video) ? $video->created_by : '') }}" class="form-control" id="created_by" aria-describedby="created_byHelp" required/>

        @error('created_by')
            <div class="error text-danger">
                {{ $message }}
            </div>
        @enderror
    </div>    <a href="{{ route('admin.video.index') }}" class="btn btn-danger mt-1">
        Cancel
    </a>
    <button class="btn btn-primary mt-1"> {{ isset($video) ? 'Update' : 'Create' }}</button>
 </form>
    </div>
    <div class="col-md-4">
    <a  class="btn btn-danger mt-1" href="{{ route('admin.video.index') }}">
    Cancel
</a>
<button class="btn btn-primary mt-1"> {{ isset($video) ? 'Update' : 'Create' }}</button>
    </div>
    </div>

    @section('scripts')
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/40.1.0/classic/ckeditor.js"></script>

    <script>
        const textareas = document.querySelectorAll('textarea');
        textareas.forEach((textarea) => {
            ClassicEditor
                .create(textarea)
                .catch(error => {
                    console.error(error);
                });
        });

        $(document).ready(function() {
            $('select').select2();
        });
        function triggerFileInput(fieldId) {
            const fileInput = document.getElementById(fieldId);
            if (fileInput) {
                fileInput.click();
            }
        }

        const imageUploads = document.querySelectorAll('.imageUpload');
        imageUploads.forEach(function(imageUpload) {
            imageUpload.addEventListener('change', function(event) {
                event.preventDefault()
                const files = this.files; // Récupérer tous les fichiers sélectionnés
                console.log(files)
                if (files && files.length > 0) {
                    const previewContainer = document.getElementById('preview_' + this.id);
                    previewContainer.innerHTML = ''; // Effacer le contenu précédent

                    for (let i = 0; i < files.length; i++) {
                        const file = files[i];
                        if (file) {
                            const reader = new FileReader();
                            const img = document.createElement('img'); // Créer un élément img pour chaque image

                            reader.onload = function(event) {
                                img.src = event.target.result;
                                img.alt = "Prévisualisation de l'image"
                                img.style.maxWidth = '100px';
                                img.style.display = 'block';
                            }

                            reader.readAsDataURL(file);
                            previewContainer.appendChild(img); // Ajouter l'image à la prévisualisation
                            console.log({img})
                            console.log({previewContainer})
                        }
                    }
                    console.log({previewContainer})
                }
            });
        });
    </script>
    @endsection