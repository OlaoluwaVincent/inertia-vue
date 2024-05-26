import { ref, toValue } from "vue";
export function usePreviewImg() {
    const previewUrl = ref("");

    function previewImage(value) {
        if (value !== null) {
            const reader = new FileReader();
            reader.onload = (event) => {
                previewUrl.value = event.target.result;
            };

            reader.readAsDataURL(value);
        }
    }

    return {
        previewUrl,
        previewImage,
    };
}
