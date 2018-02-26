<template>
  <div class="secondpage">
    <h1>Hello</h1>
    <b-message
      title="Success"
      type="is-success">
      Test second page !?
    </b-message>
  </div>
</template>

<script>
export default {
  //
}
</script>

<style lang="scss" scoped>
// Global vars
@import '../vars.scss';

h1 {
  color: red;
}
h3 {
  color: $globalTest;
}
</style>
