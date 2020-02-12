<div class="images-files with-shadow rounded-block box-white">
    <div class="with-padding">
        <div class="row">
            @foreach(only_images_files($task->files) as $file)
                <div class="col-3 images-files-item">
                    <img src="{{ $file->thumb() }}" alt="{{ $file->name }}">
                    <div class="images-files-item_buttons with-icon">
                        <a data-fslightbox="gallery" href="{{ $file->path() }}">
                            {{ svg('icon-zoom-in') }}
                        </a>
                        <a href="{{ route('files.download', ['uuid' => $task->uuid, 'id' => $file->id]) }}">
                            {{ svg('icon-cloud-download') }}
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
