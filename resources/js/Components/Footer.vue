<template>
  <section
    class="-tw-mt-0 content__padding tw-bg-secondary-blue tw-text-white lg:!tw-py-20"
  >
    <div class="inner">
      <div>
        <h1>School</h1>
        <h3 class="tw-text-sm">
          Lorem ipsum, dolor sit amet consectetur adipisicing elit. Sed, aut!
        </h3>
        <p class="tw-text-sm">
          Lorem ipsum dolor sit amet consectetur adipisicing elit. Deleniti
          quasi eaque saepe omnis recusandae tempora porro minima totam.
          Voluptatem, quidem.
        </p>
      </div>

      <div>
        <h1>Get Help</h1>
        <ul>
          <li>Contact</li>
          <li>Latest</li>
          <li>FAQ</li>
        </ul>
      </div>

      <div>
        <h1>Programs</h1>
        <ul>
          <li>One</li>
          <li>Two</li>
          <li>Three</li>
          <li>Four</li>
          <li>Five</li>
        </ul>
      </div>

      <div>
        <h1>Contact</h1>
        <p>address</p>
        <p>Telephone</p>
        <p>mail</p>
      </div>
    </div>
  </section>
</template>




<style scoped>
h1 {
  font-size: 22px;
  font-weight: 700;
}

.inner {
  display: grid;
  grid-template-columns: 1fr;
  gap: 20px;
}

@media (width>420px) {
  .inner {
    grid-template-columns: repeat(2, 1fr);
  }
}

@media (width>=1024px) {
  .inner {
    justify-items: center;
    grid-template-columns: repeat(4, 1fr);
  }
}
</style>