<template>
  <div role="progressbar"
    v-bind:class="[
    'progress-bar',
    type == 'success'?'progress-bar-success':'',
    type == 'warning'?'progress-bar-warning':'',
    type == 'info'?'progress-bar-info':'',
    type == 'danger'?'progress-bar-danger':'',
    striped?'progress-bar-striped':'',
    animated?'active':'',
    className?className:''
    ]"
    v-bind:style="{width: now + '%'}">
    {{label}}
  </div>
</template>

<script>
import { coerceBoolean } from 'vue-strap'
  export default {
    props: {
      now: {
        type: Number,
        require: true
      },
      className: {
        type: String,
        default:''
      },
      label: {
        type: String,
      },
      type: {
        type: String
      },
      striped: {
        type: Boolean,
        coerce: coerceBoolean,
        default: false
      },
      animated: {
        type: Boolean,
        coerce: coerceBoolean,
        default: false
      }
    }
  }
</script>