<!-- Reference implementation -->
<template>
  <timeLineView :_formDef="formDef"></timeLineView>
</template>

<script>
import timeLineView from '@/components//papers/view-appt-note/templates/generic-timeline-structure.vue'
import { diagnosisFormDef } from '@/components/patient-data/diagnosis/db/client-side/structure/diagnosis-of-a-patient-table.js'

export default {
  components: { timeLineView },
  data: function () {
    return {
      formDef: diagnosisFormDef,
    }
  },
}
</script>
