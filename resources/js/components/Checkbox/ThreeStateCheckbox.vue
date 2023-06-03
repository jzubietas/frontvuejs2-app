<template>
  <div>
    <input type="checkbox" :checked="checked" :indeterminate="indeterminate" @click="checkStatus" />
  </div>
</template>

<script>
export default {
  name: "Three-state-checkbox",
  data() {
    return {
      checked: false,
      indeterminate: false,
    };
  },
  methods: {
    checkStatus() {
      if (this.indeterminate) {
        this.checked = true;
        this.indeterminate = false;
        console.log("indeterminado");
      } else if (this.checked) {
        this.checked = false;
        this.indeterminate = false;
        console.log("nulo");
      } else {
        this.checked = false;
        this.indeterminate = true;
        console.log("check");
      }
    },
  },
};
</script>


