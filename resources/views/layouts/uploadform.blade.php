<div class="upload-section" id="upload-section">
    <form action="{{route('video.store')}}" method="POST" class="upload-form" enctype="multipart/form-data">
        @csrf
        <input type="file" name="video_video" id="">
        <input type="text" name="video_title" placeholder="Title">
        <textarea name="video_description" id="" ></textarea>

    </form>
</div>
