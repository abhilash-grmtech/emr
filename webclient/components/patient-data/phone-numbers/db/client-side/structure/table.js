/* For docs read webclient/docs/models.md
To see response from server: http://127.0.0.1:8000/phone-numbers/getAll
*/
import clientTblManage from '~/components/non-temporal/form-manager/manage-rows-of-table-in-client-side-orm.js'

const { v1: uuidv1 } = require('uuid')
let count = 0
const intUniqueId = () => ++count

export default class phoneNumbers extends clientTblManage {
  static entity = 'tblPhoneNumbers'

  // To work with nodejs server -> mariaDB server
  static apiUrl = process.env.baseUrl + '/phone-numbers' // fetch baseurl from enviroment variable. Goal: change baseurl as per NODE_ENV value. eg: If NODE_ENV == dev then baseurl = "http://localhost:8000" or If NODE_ENV == test then baseurl = "http://ptserver:8000"

  static primaryKey = 'clientSideUniqRowId'

  static fields() {
    return {
      ...super.fields(),

      clientSideUniqRowId: this.uid(() => intUniqueId()), // if this is not set then update based on primary key will not work
      serverSideRowUuid: this.uid(() => uuidv1()),
      ptUuid: this.string(null),
      countryCode: this.string(''),
      phoneNumber: this.string(''),
      notes: this.string(null).nullable(), // Ref: https://vuex-orm.org/guide/model/defining-models.html#primitive-types. Without specifying .null notes gets the default value of "null",
      priority: this.number(0),
      recordChangedByUuid: this.string(null),
      recordChangedFromIPAddress: this.string(null),
      recordChangedFromSection: this.string(null),

      ROW_START: this.number(0),
      ROW_END: this.number(2147483648000), // this is unix_timestamp*1000 value from mariaDB for ROW_END.  When a record is created new in MariaDB system versioned table, this value is set by MariaDB. Internally everywhere timeInMilliSecs is used.
    }
  }
}
