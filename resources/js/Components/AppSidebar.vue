<template>

 <v-navigation-drawer v-model="model" location="left" temporary>
  <v-list :items="items"></v-list>
 </v-navigation-drawer>
</template>

<script setup>
const items = [
 {
  title: 'Foo',
  value: 'foo',
 },
 {
  title: 'Bar',
  value: 'bar',
 },
 {
  title: 'Fizz',
  value: 'fizz',
 },
 {
  title: 'Buzz',
  value: 'buzz',
 },
];

const model = defineModel()
</script>