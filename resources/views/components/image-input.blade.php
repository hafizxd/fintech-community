@props([
    'disabled' => false,
    'name' => 'image',
    'src' => ''
])

<div x-data="showImage()" class="mt-1 flex items-center justify-start">
    <label
        class="flex flex-col w-60 h-60 border-4 border-dashed hover:bg-gray-700 hover:border-gray-300 hover:cursor-pointer">
        <div class="relative flex flex-col items-center justify-center pt-10">
            <img id="preview" class="absolute inset-0 w-60 h-60" src="{{ $src }}">
            <svg xmlns="http://www.w3.org/2000/svg"
                class="w-12 h-12 text-gray-400 group-hover:text-gray-600" viewBox="0 0 20 20"
                fill="currentColor">
                <path fill-rule="evenodd"
                    d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z"
                    clip-rule="evenodd" />
            </svg>
            <p class="pt-1 text-sm tracking-wider text-gray-400 group-hover:text-gray-600">
                Select a photo</p>
        </div>
        <input type="file" name="{{ $name }}" {{ $disabled ? 'disabled' : '' }} class="opacity-0" accept="image/*" @change="showPreview(event)" />
    </label>
</div>

<script>
    function showImage() {
        return {
            showPreview(event) {
                if (event.target.files.length > 0) {
                    let src = URL.createObjectURL(event.target.files[0]);
                    let imageFile = event.target.files[0];
                    let reader = new FileReader();
                    reader.onload = function (e) {
                        let img = document.createElement("img");
                        img.onload = function(event) {
                            let MAX_WIDTH = 700;
                            let MAX_HEIGHT = 700;

                            let width = img.width;
                            let height = img.height;

                            // Change the resizing logic
                            if (width > height) {
                                if (width > MAX_WIDTH) {
                                    height = height * (MAX_WIDTH / width);
                                    width = MAX_WIDTH;
                                }
                            } else {
                                if (height > MAX_HEIGHT) {
                                    width = width * (MAX_HEIGHT / height);
                                    height = MAX_HEIGHT;
                                }
                            }

                            let canvas = document.createElement("canvas");
                            canvas.width = width;
                            canvas.height = height;
                            let ctx = canvas.getContext("2d");
                            ctx.drawImage(img, 0, 0, width, height);

                            // Show resized image in preview element
                            let dataurl = canvas.toDataURL(imageFile.type);
                            let preview = document.getElementById("preview");
                            preview.src = dataurl;
                        }
                        img.src = e.target.result;
                    }
                    reader.readAsDataURL(imageFile);
                }
            }
        }
    }
</script>