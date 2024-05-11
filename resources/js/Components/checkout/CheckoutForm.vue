<template>
  <form class="country tw-w-full">
    <aside>
      <label for="country">Country</label>
      <input
        type="text"
        name="country"
        id="country"
        v-model="country"
        placeholder="Enter Country"
        required
      />
    </aside>
    <aside>
      <label for="state">State/Union Tertiary</label>
      <input
        type="text"
        name="state"
        id="state"
        v-model="state"
        placeholder="Enter State"
        required
      />
    </aside>
  </form>
  <h3>Payment Method</h3>
</template>

<script setup>
import { useForm } from "@inertiajs/vue3";

const form = useForm({
  country: "",
  state: "",
});
</script>

<style scoped>
.country {
  display: flex;
  justify-content: space-between;
  gap: 20px;
}

.country aside {
  width: 100%;
}
.country aside label {
  margin-bottom: 8px;
  font-weight: 500;
}
.country aside input {
  width: 100%;
  border: 1px solid teal;
  outline: none;
  border-radius: 8px;
}
</style>