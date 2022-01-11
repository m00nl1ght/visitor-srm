<template>
  <FullscreenModalLayout
    :isOpen="isOpen"
    :confirmBtnTitle="'Печать'"
    :onClose="onClose"
    :onConfirm="onConfirm"
    :title="'Печать пропуска посетителя'"
    class="no-print"
  >
    <!-- <div class="no-print page-header">
        <button class="page-header__button" onclick="window.print()">Печатать</button>
        <a class="page-header__link" href="{{ route('visitor-index') }}">Назад</a>
	</div> -->
    <div id="print_visitor_card">
      <div class="page">
        <div class="title">
          <h1 class="title__head">Пропуск для посетителя № {{ printCardValue.id ? printCardValue.id : '' }}</h1>
          <img class="title__img" src="@/assets/printCard/claasLogo.svg" />
        </div>

        <div class="divider"></div>

        <div class="page-container">
          <div class="left-part">
            <table class="table-box">
              <tr class="table-box__row_h10">
                <td class="table-box__item table-box__item_w50">
                  <h3 class="table-box__item-head">Посетитель:</h3>
                  <!-- <small>(Фамилия И. О., № паспорта)</small> -->
                </td>
                <td class="table-box__item">{{ printCardValue.visitor ? printFullName(printCardValue.visitor) : '' }}</td>
              </tr>

              <tr class="table-box__row_h10">
                <td class="table-box__item table-box__item_w50">
                  <h3 class="table-box__item-head">Организация:</h3>
                  <!-- <small>(отправитель, перевозчик)</small> -->
                </td>
                <td class="table-box__item">{{ printCardValue.visitor ? printCardValue.visitor.firm.title : '' }}</td>
              </tr>

              <tr class="table-box__row_h10">
                <td class="table-box__item table-box__item_w50">
                  <h3 class="table-box__item-head">Контактное лицо:</h3>
                  <small>(со стороны ООО "КЛААС")</small>
                </td>
                <td class="table-box__item">{{ printCardValue.employee ? printFullName(printCardValue.employee) : '' }}</td>
              </tr>
            </table>

            <div class="warning-message">
              <h3 class="warning-message__text">Внимание!</h3>
              <p class="warning-message__text">Ознакомьтесь с правилами пребывания на предприятии</p>
              <small>(на обратной стороне бланка)</small>
              <img class="warning-message__img" src="@/assets/printCard/signs.png" />
            </div>

            <table class="table-box">
              <tr class="table-box__row_h10">
                <th class="table-box__item table-box__item_center" colspan="2">с правилами ознакомлен</th>
              </tr>
              <tr class="table-box__row_h10">
                <th class="table-box__item table-box__item_center table-box__item_w50">Дата</th>
                <th class="table-box__item table-box__item_center">Подпись</th>
              </tr>
              <tr class="table-box__row_h10">
                <td class="table-box__item table-box__item_center table-box__item_w50">
                  {{ printCardValue.inTime ? $moment(printCardValue.inTime).format('DD.MM.YYYY') : '' }}
                </td>
                <td class="table-box__item"></td>
              </tr>
            </table>
          </div>

          <div class="right-part">
            <table class="table-box">
              <tr class="table-box__row_h10">
                <th class="table-box__item" colspan="2">Прибытие</th>
              </tr>

              <tr class="table-box__row_h10">
                <td class="table-box__item table-box__item_w50">Дата</td>
                <td class="table-box__item">{{ printCardValue.inTime ? $moment(printCardValue.inTime).format('DD.MM.YYYY') : '' }}</td>
              </tr>

              <tr class="table-box__row_h10">
                <td class="table-box__item table-box__item_w50">Время</td>
                <td class="table-box__item">{{ printCardValue.inTime ? $moment(printCardValue.inTime).format('HH:mm') : '' }}</td>
              </tr>

              <tr class="table-box__row_h10">
                <td class="table-box__item table-box__item_w50">Ф.И.О. сотрудника охраны</td>
                <td class="table-box__item">{{ printCardValue.security ? getShortName(printCardValue.security) : '' }}</td>
              </tr>
            </table>

            <table class="table-box">
              <tr class="table-box__row_h10">
                <th class="table-box__item" colspan="2">Отметки сотрудника охраны</th>
              </tr>
              <tr class="table-box__row_h10">
                <td class="table-box__item table-box__item_w50">Время убытия</td>
                <td class="table-box__item"></td>
              </tr>
              <tr class="table-box__row_h10">
                <td class="table-box__item table-box__item_w50">Ф.И.О. сотрудника охраны</td>
                <td class="table-box__item"></td>
              </tr>
            </table>

            <table class="table-box">
              <tr class="table-box__row_h10">
                <th class="table-box__item" colspan="2">Отметки сотрудника "КЛААС"</th>
              </tr>
              <tr class="table-box__row_h10">
                <td class="table-box__item table-box__item_w50">Время убытия</td>
                <td class="table-box__item"></td>
              </tr>
              <tr class="table-box__row_h10">
                <td class="table-box__item table-box__item_w50">Ф.И.О. сотрудника<br />ООО "КЛААС"</td>
                <td class="table-box__item"></td>
              </tr>
              <tr class="table-box__row_h10">
                <td class="table-box__item table-box__item_w50">Подпись</td>
                <td class="table-box__item"></td>
              </tr>
            </table>
          </div>
        </div>
      </div>

      <div class="page">
        <div class="rules">
          <div class="rules__header">Пожалуйста, соблюдайте правила пребывания на территории предприятия:</div>
          <ul class="rules__list">
            <li class="rules__list-item">Следуйте правилам безопасности, с которыми Вас ознакомили сотрудники охраны;</li>
            <li class="rules__list-item">Транспортные средства ООО «КЛААС» имеют право преимущественного проезда;</li>
            <li class="rules__list-item">Передвижение по территории только в сопровождении или по маршруту, указанному сотрудником ООО «КЛААС»;</li>
            <li class="rules__list-item">Парковка разрешена только в специально отведенных местах;</li>
            <li class="rules__list-item">Запрещен доступ на территорию зоны таможенного контроля, отмеченной соответствующим знаком;</li>
            <li class="rules__list-item">Запрещены фото- и видеосъемка;</li>
            <li class="rules__list-item">
              Перемещаться по территории завода только в сопровождении сотрудника ООО «КЛААС» или строго по указанному сотрудником охраны маршруту;
            </li>
            <li class="rules__list-item">
              Запрещается находиться в производственных помещениях без сопровождения сотрудника ООО «КЛААС» и без средств индивидуальной защиты;
            </li>
            <li class="rules__list-item">Запрещено курение, за исключением специально отведенных мест;</li>
            <li class="rules__list-item">Сотрудники охраны могут произвести осмотр транспортных средств, сумок и других имеющихся при себе вещей.</li>
          </ul>
        </div>
      </div>
    </div>
  </FullscreenModalLayout>
</template>

<script>
import FullscreenModalLayout from '@/components/app/modals/FullscreenModalLayout'
import peopleHelper from '@/services/helpers/people.js'

export default {
  props: {
    isOpen: Boolean,
    onClose: Function,
    printCardValue: Object
  },

  components: {
    FullscreenModalLayout
  },

  methods: {
    async onConfirm() {
      await this.$htmlToPaper('print_visitor_card')
    },

    printFullName(person) {
      return peopleHelper.getFullName(person)
    },

    getShortName(person) {
      return peopleHelper.getShortName(person)
    }
  }
}
</script>

<style lang="scss" scoped>
$divider-color: #66cc00;

@page {
  margin: 0;
}

@media print {
  // body {
  //     width: 210mm;
  // }
  .no-print,
  .no-print * {
    display: none !important;
  }
}

@media screen {
  .page {
    background: white;
    box-shadow: 0 0.5mm 2mm rgba(0, 0, 0, 0.3);
    margin: 5mm auto;
  }
}

// body {
//     width: 210mm;
//     margin: 0 auto;
//     font-family: sans-serif;
//     font-size: 3.8mm;
// }

.header-print {
  padding: 10px 0;
  border-bottom: solid #000000 1px;
}

.header__button {
  padding: 5px 10px;
  font-size: 16px;
}

.page {
  padding: 5mm;
  width: 210mm;
  height: 147mm;
  overflow: hidden;
  position: relative;
  box-sizing: border-box;
  page-break-after: always;

  font-family: sans-serif;
  font-size: 3.8mm;
}

.second-page {
  padding: 10mm 5mm;
}
.second-page__head {
  margin: 0;
  text-align: center;
}

.second-page__list-item {
  margin-top: 1mm;
}

.page-container {
  display: flex;
  justify-content: space-between;

  height: 120mm;
}

.page-header {
  display: flex;
  justify-content: space-between;
  align-items: center;

  max-width: 800px;
  min-height: 60px;
  margin: 0 auto;
}

.page-header__button {
  padding: 5px 10px;
  font-size: 14px;
}

.page-header__link {
  font-size: 16px;
}

.title {
  display: flex;
  align-items: center;
  justify-content: space-between;

  height: 10mm;
}

.title__head {
  display: inline-block;

  margin: 0;

  font-size: 4mm;
  font-weight: bold;
  text-transform: uppercase;
}

.title__img {
  height: 8mm;
}

.divider {
  border-top: solid $divider-color 1.5mm;
  height: 1mm;
  border-bottom: solid $divider-color 1mm;
  margin-bottom: 2mm;
}

.left-part {
  display: flex;
  justify-content: space-between;
  flex-direction: column;
  width: 54%;
}

.right-part {
  display: flex;
  justify-content: space-between;
  flex-direction: column;
  width: 45%;
}

.table-box {
  border-collapse: collapse;
  width: 100%;
}

.table-box__row_h10 {
  height: 10mm;
}

.table-box__row_h8 {
  height: 8mm;
}

.table-box__item {
  border: solid black 2px;
  padding: 1mm;
}

.table-box__item_w50 {
  width: 50mm;
}

.table-box__item_center {
  text-align: center;
}

.table-box__item-head {
  margin: 0;
  font-size: 3.8mm;
}

.table-box__caption {
  font-size: 4mm;
  font-weight: bold;
  margin-bottom: 0.5mm;
}

.warning-message {
  font-size: 4.2mm;
  text-align: center;
  border: solid black 2px;
  padding: 1mm;
}

.warning-message__text {
  margin: 0;
}

.warning-message__img {
  margin-top: 1mm;
  width: 90mm;
}

.rules {
  padding: 20px 0;
}
.rules__header {
  font-size: 7mm;
  font-weight: 700;
  text-align: center;
}

.rules__list {
  margin: 0;
  margin-top: 25px;

  font-size: 4.5mm;
}

.rules__list-item {
  margin-top: 10px;
}
</style>
