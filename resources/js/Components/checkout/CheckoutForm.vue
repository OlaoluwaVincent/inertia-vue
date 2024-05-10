<template>
  <section class="tw-w-full">
    <div class="country">
      <aside>
        <label for="country">Country</label>
        <input
          type="text"
          name="country"
          id="country"
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
          placeholder="Enter State"
          required
        />
      </aside>
    </div>
    <h3>Payment Method</h3>
  </section>
</template>

<script setup>
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