export default {
  getShortName(people) {
    let str = `${people.lastName + " "}
    ${people.name.slice(0, 1) + '. '}
    ${ people.middleName && people.middleName.length !== 0 ? people.middleName.slice(0, 1) + "." : '' }`

    return str
  },

  getFullName(people) {
    return `${people.lastName} ${people.name} ${people.middleName && people.middleName.length !== 0 ? people.middleName : ''}`
  }
}