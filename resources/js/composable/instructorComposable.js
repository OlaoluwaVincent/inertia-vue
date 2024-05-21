import { computed } from "vue";

export function keyPressed(type, langRef, formRef, expertRef) {
    if (type === "languages") {
        if (!langRef.value.length) return;

        formRef.languages.push(langRef.value);
        return (langRef.value = "");
    } else {
        if (!expertRef.value.length) return;

        formRef.expertise.push(expertRef.value);
        expertRef.value = "";
    }
}

export function keyPressedAction(selectRef, formRef) {
    if (!selectRef.value.length) return;

    formRef.push(selectRef.value);
    return (selectRef.value = "");
}

export function deleteOne(index, formRef) {
    const data = computed(() => formRef.filter((item, id) => id !== index));
    return data.value;
}
export function deleteItem(type, itemId, formRef) {
    const index = itemId;
    if (type === "languages") {
        formRef.languages = formRef.languages.filter(
            (item, id) => id !== index
        );
    } else {
        formRef.expertise = formRef.expertise.filter(
            (item, id) => id !== index
        );
    }
}
