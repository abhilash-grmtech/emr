import clientTblManage from '~/components/framework/crud/manage-rows-of-table-in-client-side-orm.js'
import mentalStatusExamForPatientClass from './mental-status-exam-of-a-patient-table.js'

const { v1: uuidv1 } = require('uuid')
let count = 0
const intUniqueId = () => ++count

export default class mentalStatusExamAllSelectOptions extends clientTblManage {
  static entity = 'tblMentalStatusExamAllSelectOptions'

  static apiUrl = 'http://localhost:8000/public/api/mental-status-exam/v20'

  static primaryKey = 'mentalStatusExamFieldOptionId'

  static fields() {
    return {
      ...super.fields(),

      mentalStatusExamFieldOptionId: this.uid(() => intUniqueId()), // if this is not set then update based on primary key will not work This is the unique ID for each service statement
      mentalStatusExamFieldOptionLabel: this.string(null),
      mentalStatusExamFieldNameInDb: this.string(null),

      ROW_END: this.number(2147483648000), // this is unix_timestamp value from mariaDB for ROW_END when a record is created new in MariaDB system versioned table.
    }
  }
}