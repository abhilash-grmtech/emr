<template>
  <div style="display: grid; grid-template-columns: repeat(7, 1fr); border: 2px solid #ebeef5; border-radius: 15px">
    <div
      style="
        writing-mode: vertical-rl;
        transform: rotate(180deg);
        text-align: center;
        grid-column-start: 1;
        grid-column-end: 2;
        grid-row-start: 1;
        grid-row-end: 33;
        font-size: 5rem;
        color: #909399;
      "
    >
      Medical decision making
    </div>
    <div
      style="
        grid-column-start: 2;
        grid-column-end: 5;
        font-size: 1.2rem;
        border: 1px solid #dcdfe6;
        text-align: center;
        font-weight: bold;
      "
    >
      Medical Decision Making Element
    </div>
    <div
      style="
        grid-column-start: 5;
        grid-column-end: 8;
        font-size: 1.2rem;
        border: 1px solid #dcdfe6;
        text-align: center;
        font-weight: bold;
      "
    >
      Determined by
    </div>
    <div style="grid-column: 2/5; font-size: 1rem; border: 1px solid #dcdfe6; text-align: center">
      Number of diagnoses or management options
    </div>
    <div style="grid-column: 5/8; font-size: 1rem; border: 1px solid #dcdfe6; text-align: center">
      Problem points chart
    </div>
    <div style="grid-column: 2/5; font-size: 1rem; border: 1px solid #dcdfe6; text-align: center">
      Amount and/or complexity of data to be reviewed
    </div>
    <div style="grid-column: 5/8; font-size: 1rem; border: 1px solid #dcdfe6; text-align: center">
      Data points chart
    </div>
    <div style="grid-column: 2/5; font-size: 1rem; border: 1px solid #dcdfe6; text-align: center">
      Risk of significant complications, morbidity, and/or mortality
    </div>
    <div style="grid-column: 5/8; font-size: 1rem; border: 1px solid #dcdfe6; text-align: center">Table of risk</div>
    <div
      style="
        grid-column-start: 2;
        grid-column-end: 8;
        font-size: 1.5rem;
        border: 1px solid #dcdfe6;
        text-align: center;
        font-weight: bold;
      "
    >
      Problem Points ({{ problemPointsTotal }})
    </div>
    <div
      style="
        grid-column-start: 2;
        grid-column-end: 6;
        font-size: 1.2rem;
        border: 1px solid #dcdfe6;
        text-align: center;
        font-weight: bold;
      "
    >
      Category or Problems/Major New Symptoms
    </div>
    <div
      style="
        grid-column-start: 6;
        grid-column-end: 8;
        font-size: 1.2rem;
        border: 1px solid #dcdfe6;
        text-align: center;
        font-weight: bold;
      "
    >
      Points per problem
    </div>
    <div style="grid-column: 2/6; font-size: 1rem; text-align: center; border: 1px solid #dcdfe6">
      Self-limiting or minor (stable, improved, or worsening (max=2)
      <el-input-number
        size="small"
        v-model="features.medDecisionMaking.problemPoints.selfLimiting"
        :min="0"
        :max="2"
      ></el-input-number>
    </div>
    <div style="grid-column: 6/8; font-size: 1rem; text-align: center; border: 1px solid #dcdfe6">1</div>
    <div style="grid-column: 2/6; font-size: 1rem; text-align: center; border: 1px solid #dcdfe6">
      Established problem (to examining physician); stable or improved
      <el-input-number
        v-model="features.medDecisionMaking.problemPoints.establishedStable"
        :min="0"
        :max="12"
      ></el-input-number>
    </div>
    <div style="grid-column: 6/8; font-size: 1rem; text-align: center; border: 1px solid #dcdfe6">2</div>
    <div style="grid-column: 2/6; font-size: 1rem; text-align: center; border: 1px solid #dcdfe6">
      Established problem (to examining physician); worsening
      <el-input-number
        v-model="features.medDecisionMaking.problemPoints.establishedWorsening"
        :min="0"
        :max="12"
      ></el-input-number>
    </div>
    <div style="grid-column: 6/8; font-size: 1rem; text-align: center; border: 1px solid #dcdfe6">3</div>
    <div style="grid-column: 2/6; font-size: 1rem; text-align: center; border: 1px solid #dcdfe6">
      New problem (to examining physician); no additional workup or diagnostic procedures ordered (max=1)
      <el-input-number
        v-model="features.medDecisionMaking.problemPoints.newToExamining"
        :min="0"
        :max="12"
      ></el-input-number>
    </div>
    <div style="grid-column: 6/8; font-size: 1rem; text-align: center; border: 1px solid #dcdfe6">4</div>
    <div style="grid-column: 2/6; font-size: 1rem; text-align: center; border: 1px solid #dcdfe6">
      New problem (to examining physician); additional workup planned (Additional workup does not include referring
      patient to another physician for future care)
      <el-input-number
        v-model="features.medDecisionMaking.problemPoints.newAdditionalWorkup"
        :min="0"
        :max="12"
      ></el-input-number>
    </div>
    <div style="grid-column: 6/8; font-size: 1rem; text-align: center; border: 1px solid #dcdfe6">5</div>
    <div
      style="
        grid-column-start: 2;
        grid-column-end: 8;
        font-size: 1.5rem;
        border: 1px solid #dcdfe6;
        text-align: center;
        font-weight: bold;
      "
    >
      Data points ({{ dataPoints }})
    </div>

    <div
      style="
        grid-column-start: 2;
        grid-column-end: 7;
        font-size: 1.2rem;
        border: 1px solid #dcdfe6;
        text-align: center;
        font-weight: bold;
      "
    >
      Categories of Data to be Reviewed (max=1 for each)
    </div>
    <div
      style="
        grid-column-start: 7;
        grid-column-end: 8;
        font-size: 1.2rem;
        border: 1px solid #dcdfe6;
        text-align: center;
        font-weight: bold;
      "
    >
      Points
    </div>
    <div style="grid-column: 2/7; font-size: 1rem; text-align: center; border: 1px solid #dcdfe6">
      <el-button
        round
        size="mini"
        :class="features.medDecisionMaking.dataPoints.reviewOrderClinical === true ? '' : 'strike'"
        :type="features.medDecisionMaking.dataPoints.reviewOrderClinical === true ? 'primary' : ''"
        @click="
          features.medDecisionMaking.dataPoints.reviewOrderClinical = !features.medDecisionMaking.dataPoints
            .reviewOrderClinical
        "
      >
        Review and/or order of clinical lab tests</el-button
      >
    </div>
    <div :class="features.medDecisionMaking.dataPoints.reviewOrderClinical === true ? 'notStrike' : 'strike'">1</div>
    <div style="grid-column: 2/7; font-size: 1rem; text-align: center; border: 1px solid #dcdfe6">
      <el-button
        round
        size="mini"
        :class="features.medDecisionMaking.dataPoints.reviewOrderRadiology === true ? '' : 'strike'"
        :type="features.medDecisionMaking.dataPoints.reviewOrderRadiology === true ? 'primary' : ''"
        @click="
          features.medDecisionMaking.dataPoints.reviewOrderRadiology = !features.medDecisionMaking.dataPoints
            .reviewOrderRadiology
        "
      >
        Review and/or order of tests in the radiology section of CPT</el-button
      >
    </div>
    <div :class="features.medDecisionMaking.dataPoints.reviewOrderRadiology === true ? 'notStrike' : 'strike'">1</div>
    <div style="grid-column: 2/7; font-size: 1rem; text-align: center; border: 1px solid #dcdfe6">
      <el-button
        round
        size="mini"
        :class="features.medDecisionMaking.dataPoints.reviewOrderMedicine === true ? '' : 'strike'"
        :type="features.medDecisionMaking.dataPoints.reviewOrderMedicine === true ? 'primary' : ''"
        @click="
          features.medDecisionMaking.dataPoints.reviewOrderMedicine = !features.medDecisionMaking.dataPoints
            .reviewOrderMedicine
        "
      >
        Review and/or order of tests in the medicine section of CPT</el-button
      >
    </div>
    <div :class="features.medDecisionMaking.dataPoints.reviewOrderMedicine === true ? 'notStrike' : 'strike'">1</div>
    <div style="grid-column: 2/7; font-size: 1rem; text-align: center; border: 1px solid #dcdfe6">
      <el-button
        round
        size="mini"
        :class="features.medDecisionMaking.dataPoints.discussionTestResults === true ? '' : 'strike'"
        :type="features.medDecisionMaking.dataPoints.discussionTestResults === true ? 'primary' : ''"
        @click="
          features.medDecisionMaking.dataPoints.discussionTestResults = !features.medDecisionMaking.dataPoints
            .discussionTestResults
        "
      >
        Discussion of test results with performing physician</el-button
      >
    </div>
    <div :class="features.medDecisionMaking.dataPoints.discussionTestResults === true ? 'notStrike' : 'strike'">1</div>
    <div style="grid-column: 2/7; font-size: 1rem; text-align: center; border: 1px solid #dcdfe6">
      <el-button
        round
        size="mini"
        :class="features.medDecisionMaking.dataPoints.decisionOldRecords === true ? '' : 'strike'"
        :type="features.medDecisionMaking.dataPoints.decisionOldRecords === true ? 'primary' : ''"
        @click="
          features.medDecisionMaking.dataPoints.decisionOldRecords = !features.medDecisionMaking.dataPoints
            .decisionOldRecords
        "
      >
        Decision to obtain old records</el-button
      ><sub><br />And/or obtain history from someone other than patient</sub>
    </div>
    <div :class="features.medDecisionMaking.dataPoints.decisionOldRecords === true ? 'notStrike' : 'strike'">1</div>
    <div style="grid-column: 2/7; font-size: 1rem; text-align: center; border: 1px solid #dcdfe6">
      <el-button
        round
        size="mini"
        :class="features.medDecisionMaking.dataPoints.reviewOldRecords === true ? '' : 'strike'"
        :type="features.medDecisionMaking.dataPoints.reviewOldRecords === true ? 'primary' : ''"
        @click="
          features.medDecisionMaking.dataPoints.reviewOldRecords = !features.medDecisionMaking.dataPoints
            .reviewOldRecords
        "
      >
        Review and summarization of old records </el-button
      ><sub
        ><br />Obtaining history from someone other than patient and/or discussion of case with another health care
        provider</sub
      >
    </div>
    <div :class="features.medDecisionMaking.dataPoints.reviewOldRecords === true ? 'notStrike' : 'strike'">2</div>
    <div style="grid-column: 2/7; font-size: 1rem; text-align: center; border: 1px solid #dcdfe6">
      <el-button
        round
        size="mini"
        :class="features.medDecisionMaking.dataPoints.independentTracing === true ? '' : 'strike'"
        :type="features.medDecisionMaking.dataPoints.independentTracing === true ? 'primary' : ''"
        @click="
          features.medDecisionMaking.dataPoints.independentTracing = !features.medDecisionMaking.dataPoints
            .independentTracing
        "
      >
        Independent visualization of image, tracing, or specimen itself</el-button
      >
      <sub><br />(not simply review report)</sub>
    </div>
    <div :class="features.medDecisionMaking.dataPoints.independentTracing === true ? 'notStrike' : 'strike'">2</div>
    <div
      style="
        grid-column-start: 2;
        grid-column-end: 8;
        font-size: 1.5rem;
        border: 1px solid #dcdfe6;
        text-align: center;
        font-weight: bold;
      "
    >
      Table of risk
      <div style="font-size: 1rem; font-weight: normal">
        <sub>(The highest level of risk in any one category determines the overall risk. Ref: Page 66 burd manual)</sub>
      </div>
    </div>

    <div
      style="
        grid-column-start: 2;
        grid-column-end: 3;
        font-size: 1rem;
        text-align: center;
        border: 1px solid #dcdfe6;
        font-weight: bold;
      "
    >
      Level of risk {{ riskLevel }}
    </div>
    <div
      style="
        grid-column-start: 3;
        grid-column-end: 5;
        font-size: 1rem;
        text-align: center;
        border: 1px solid #dcdfe6;
        font-weight: bold;
      "
    >
      Presenting problems
    </div>
    <div style="grid-column: 5/6; font-size: 1rem; text-align: center; border: 1px solid #dcdfe6; font-weight: bold">
      Diagnostic procedure ordered
    </div>
    <div style="grid-column: 6/8; font-size: 1rem; text-align: center; border: 1px solid #dcdfe6; font-weight: bold">
      Management options selected
    </div>

    <div :class="features.medDecisionMaking.risk.type >= 1 ? 'notStrike' : 'strike'">Minimal</div>
    <div style="grid-column: 3/5; font-size: 1rem; text-align: center; border: 1px solid #dcdfe6">
      <el-button
        round
        size="mini"
        :class="features.medDecisionMaking.risk.problem >= 1 ? '' : 'strike'"
        :type="features.medDecisionMaking.risk.problem >= 1 ? 'primary' : ''"
        @click="features.medDecisionMaking.risk.problem = 1"
        >One self-limited</el-button
      >
      <br />
      <sub>or minor problem</sub>
    </div>
    <div style="grid-column: 5/6; font-size: 1rem; text-align: center; border: 1px solid #dcdfe6">
      <el-button
        round
        size="mini"
        :class="features.medDecisionMaking.risk.diagnostic >= 1 ? '' : 'strike'"
        :type="features.medDecisionMaking.risk.diagnostic >= 1 ? 'primary' : ''"
        @click="features.medDecisionMaking.risk.diagnostic = 1"
        >Venipuncture; EKG; urinalysis</el-button
      >
    </div>
    <div style="grid-column: 6/8; font-size: 1rem; text-align: center; border: 1px solid #dcdfe6">
      <el-button
        round
        size="mini"
        :class="features.medDecisionMaking.risk.management >= 1 ? '' : 'strike'"
        :type="features.medDecisionMaking.risk.management >= 1 ? 'primary' : ''"
        @click="features.medDecisionMaking.risk.management = 1"
        >Rest</el-button
      >
    </div>

    <div :class="features.medDecisionMaking.risk.type >= 2 ? 'notStrike' : 'strike'">Low</div>
    <div style="grid-column: 3/5; font-size: 1rem; text-align: center; border: 1px solid #dcdfe6">
      <el-button
        round
        size="mini"
        :class="features.medDecisionMaking.risk.problem >= 2 ? '' : 'strike'"
        :type="features.medDecisionMaking.risk.problem >= 2 ? 'primary' : ''"
        @click="features.medDecisionMaking.risk.problem = 2"
        >Stable</el-button
      ><br />
      <sub>Two or more self-limited or minor problems; One stable chronic illness; Acute uncomplicated illness</sub>
    </div>
    <div style="grid-column: 5/6; font-size: 1rem; text-align: center; border: 1px solid #dcdfe6">
      <el-button
        round
        size="mini"
        :class="features.medDecisionMaking.risk.diagnostic >= 2 ? '' : 'strike'"
        :type="features.medDecisionMaking.risk.diagnostic >= 2 ? 'primary' : ''"
        @click="features.medDecisionMaking.risk.diagnostic = 2"
        >Arterial puncture</el-button
      >
    </div>
    <div style="grid-column: 6/8; font-size: 1rem; text-align: center; border: 1px solid #dcdfe6">
      <el-button
        round
        size="mini"
        :class="features.medDecisionMaking.risk.management >= 2 ? '' : 'strike'"
        :type="features.medDecisionMaking.risk.management >= 2 ? 'primary' : ''"
        @click="features.medDecisionMaking.risk.management = 2"
        >OTC drugs</el-button
      >
    </div>

    <div :class="features.medDecisionMaking.risk.type >= 3 ? 'notStrike' : 'strike'">Moderate</div>
    <div style="grid-column: 3/5; font-size: 1rem; text-align: center; border: 1px solid #dcdfe6">
      <el-button
        round
        size="mini"
        :class="features.medDecisionMaking.risk.problem >= 3 ? '' : 'strike'"
        :type="features.medDecisionMaking.risk.problem >= 3 ? 'primary' : ''"
        @click="features.medDecisionMaking.risk.problem = 3"
        >Systemic symptoms</el-button
      ><br />
      <sub
        >One or more chronic illnesses with mild exacerbation, progression, or side effects; Two or more stable chronic
        illnesses; Undiagnosed new problem with uncertain prognosis; Acute illness with systemic symptoms</sub
      >
    </div>
    <div style="grid-column: 5/6; font-size: 1rem; text-align: center; border: 1px solid #dcdfe6">
      Electroencephalogram Neuropsychological testing
    </div>
    <div style="grid-column: 6/8; font-size: 1rem; text-align: center; border: 1px solid #dcdfe6">
      <el-button
        round
        size="mini"
        :class="features.medDecisionMaking.risk.management >= 3 ? '' : 'strike'"
        :type="features.medDecisionMaking.risk.management >= 3 ? 'primary' : ''"
        @click="features.medDecisionMaking.risk.management = 3"
        >Prescription drug management</el-button
      >
    </div>

    <div :class="features.medDecisionMaking.risk.type >= 4 ? 'notStrike' : 'strike'">High</div>
    <div style="grid-column: 3/5; font-size: 1rem; text-align: center; border: 1px solid #dcdfe6">
      <el-button
        round
        size="mini"
        :class="features.medDecisionMaking.risk.problem >= 4 ? '' : 'strike'"
        :type="features.medDecisionMaking.risk.problem >= 4 ? 'primary' : ''"
        @click="features.medDecisionMaking.risk.problem = 4"
        >Threat to bodily function</el-button
      >
      <br /><sub>
        One or more chronic illnesses with severe exacerbation, progression, or side effects; Acute or chronic illnesses
        that pose a threat to life or bodily function</sub
      >
    </div>
    <div style="grid-column: 5/6; font-size: 1rem; text-align: center; border: 1px solid #dcdfe6">
      Lumbar puncture suicide risk assessment
    </div>
    <div style="grid-column: 6/8; font-size: 1rem; text-align: center; border: 1px solid #dcdfe6">
      <el-button
        round
        size="mini"
        :class="features.medDecisionMaking.risk.management >= 4 ? '' : 'strike'"
        :type="features.medDecisionMaking.risk.management >= 4 ? 'primary' : ''"
        @click="features.medDecisionMaking.risk.management = 4"
        >Drug therapy</el-button
      >
      <br /><sub>Requiring intensive monitoring for toxicity</sub>
    </div>
    <div style="grid-column: 2/ 8; text-align: center">2/3 elements must be met or exceeded</div>
    <div
      style="
        grid-column-start: 2;
        grid-column-end: 3;
        font-size: 1rem;
        border: 1px solid #dcdfe6;
        text-align: center;
        font-weight: bold;
      "
    >
      Problem points
    </div>
    <div
      style="
        grid-column-start: 3;
        grid-column-end: 4;
        font-size: 1rem;
        text-align: center;
        border: 1px solid #dcdfe6;
        font-weight: bold;
      "
    >
      Data points
    </div>
    <div
      style="
        grid-column-start: 4;
        grid-column-end: 5;
        font-size: 1rem;
        text-align: center;
        border: 1px solid #dcdfe6;
        font-weight: bold;
      "
    >
      Risk
    </div>
    <div
      style="grid-column: 5/8; font-size: 1rem; text-align: center; border: 1px solid #dcdfe6; font-weight: bold"
      @click="features.medDecisionMaking.summaryDisplay = !features.medDecisionMaking.summaryDisplay"
    >
      Complexity of decison making ({{ complexity }}) (min)
    </div>

    <div :class="features.medDecisionMaking.problemPoints.total >= 0 ? 'notStrike' : 'strike'">0-1</div>
    <div :class="features.medDecisionMaking.dataPoints.points >= 0 ? 'notStrike' : 'strike'">0-1</div>
    <div :class="features.medDecisionMaking.risk.type >= 1 ? 'notStrike' : 'strike'">Minimal</div>

    <div
      id="complexity"
      style="grid-column: 5/8"
      :class="features.medDecisionMaking.complexity.level >= 1 ? 'notStrike' : 'strike'"
    >
      Straight forward
    </div>

    <div :class="features.medDecisionMaking.problemPoints.total >= 2 ? 'notStrike' : 'strike'">2</div>
    <div :class="features.medDecisionMaking.dataPoints.points >= 2 ? 'notStrike' : 'strike'">2</div>
    <div :class="features.medDecisionMaking.risk.type >= 2 ? 'notStrike' : 'strike'">Low</div>

    <div
      id="complexity"
      style="grid-column: 5/8"
      :class="features.medDecisionMaking.complexity.level >= 2 ? 'notStrike' : 'strike'"
    >
      Low
    </div>

    <div :class="features.medDecisionMaking.problemPoints.total >= 3 ? 'notStrike' : 'strike'">3</div>
    <div :class="features.medDecisionMaking.dataPoints.points >= 3 ? 'notStrike' : 'strike'">3</div>
    <div :class="features.medDecisionMaking.risk.type >= 3 ? 'notStrike' : 'strike'">Moderate</div>

    <div
      id="complexity"
      style="grid-column: 5/8"
      :class="features.medDecisionMaking.complexity.level >= 3 ? 'notStrike' : 'strike'"
    >
      Moderate
    </div>

    <div :class="features.medDecisionMaking.problemPoints.total >= 4 ? 'notStrike' : 'strike'">4</div>
    <div :class="features.medDecisionMaking.dataPoints.points >= 4 ? 'notStrike' : 'strike'">4</div>
    <div :class="features.medDecisionMaking.risk.type >= 4 ? 'notStrike' : 'strike'">High</div>
    <div
      id="complexity"
      style="grid-column: 5/8"
      :class="features.medDecisionMaking.complexity.level >= 4 ? 'notStrike' : 'strike'"
    >
      High
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      num: 0,
    }
  },
  props: {
    features: {
      type: Object,
      required: true,
    },
  },
  computed: {
    dataPoints: function () {
      let points = 0
      points = points + (this.features.medDecisionMaking.dataPoints.reviewOrderClinical ? 1 : 0)

      points = points + (this.features.medDecisionMaking.dataPoints.reviewOrderRadiology ? 1 : 0)

      points = points + (this.features.medDecisionMaking.dataPoints.reviewOrderMedicine ? 1 : 0)
      points = points + (this.features.medDecisionMaking.dataPoints.discussionTestResults ? 1 : 0)
      points = points + (this.features.medDecisionMaking.dataPoints.decisionOldRecords ? 1 : 0)
      points = points + (this.features.medDecisionMaking.dataPoints.reviewOldRecords ? 2 : 0)
      points = points + (this.features.medDecisionMaking.dataPoints.independentTracing ? 2 : 0)

      this.features.medDecisionMaking.dataPoints.points = points
      return points
    },
    riskLevel: function () {
      this.features.medDecisionMaking.risk.type = Math.max(
        this.features.medDecisionMaking.risk.problem,
        this.features.medDecisionMaking.risk.diagnostic,
        this.features.medDecisionMaking.risk.management
      )
    },
    problemPointsTotal: function () {
      this.features.medDecisionMaking.problemPoints.total =
        this.features.medDecisionMaking.problemPoints.selfLimiting +
        this.features.medDecisionMaking.problemPoints.establishedStable * 2 +
        this.features.medDecisionMaking.problemPoints.establishedWorsening * 3 +
        this.features.medDecisionMaking.problemPoints.newToExamining * 4 +
        this.features.medDecisionMaking.problemPoints.newAdditionalWorkup * 5

      return this.features.medDecisionMaking.problemPoints.total
    },
    complexity: function () {
      let problemPointLevel = 0
      if (this.features.medDecisionMaking.problemPoints.total === 0) {
        problemPointLevel = 1
      } else if (this.features.medDecisionMaking.problemPoints.total === 2) {
        problemPointLevel = 2
      } else if (this.features.medDecisionMaking.problemPoints.total === 3) {
        problemPointLevel = 3
      } else if (this.features.medDecisionMaking.problemPoints.total > 4) {
        problemPointLevel = 4
      }

      let dataPointsLevel = 0
      if (this.features.medDecisionMaking.dataPoints.points == 0) {
        dataPointsLevel = 1
      } else {
        dataPointsLevel = this.features.medDecisionMaking.dataPoints.points
      }

      let riskLevel = 0
      riskLevel = this.features.medDecisionMaking.risk.type

      // get two highest values
      let levels = new Array()
      levels[0] = problemPointLevel
      levels[1] = dataPointsLevel
      levels[2] = riskLevel

      levels.sort((a, b) => b - a) // now array index 0 is highest level and array index 1 is 2nd highest level

      this.features.medDecisionMaking.complexity.level = levels[1]

      // console.log(this.features.medDecisionMaking.complexity.level)

      return levels[1]
    },
  },
}
</script>
