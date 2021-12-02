<template>
  <FullscreenModalLayout
    :isOpen="isOpen"
    :confirmBtnTitle="'Печать'"
    :onClose="onClose"
    :onConfirm="onConfirm"
    :title="'Печать пропуска для автомобиля'"
  >
    <div id="print_car_card">
      <div class="page">
        <div class="title">
          <h1 class="title__head">Пропуск для автомобиля № {{ printCardValue.id ? printCardValue.id : ''  }}</h1>
          <img class="title__img" src="@/assets/printCard/claasLogo.svg"/>
        </div>
            
        <div class="divider"></div>
            
        <div class="page-container">
            <div class="left-part">
                <table class="table-box">
                    <tr>
                        <td class="table-box__item table-box__item_w50">
                            <h3 class="table-box__item-head">Автомобиль:</h3>
                            <small>(модель, гос. рег. знак)</small>
                        </td>
                        <td class="table-box__item">{{ printCardValue.visitor ? printCardValue.visitor.car.regNumber : '' }}</td>
                    </tr>

                    <tr>
                        <td class="table-box__item table-box__item_w50">
                            <h3 class="table-box__item-head">Водитель:</h3>
                            <small>(Фамилия И. О., № паспорта)</small>
                        </td>
                        <td class="table-box__item">{{ printCardValue.visitor ? getShortName(printCardValue.visitor) : '' }}</td>
                    </tr>

                    <tr>
                        <td class="table-box__item table-box__item_w50">
                            <h3 class="table-box__item-head">Организация:</h3>
                            <small>(отправитель, перевозчик)</small>
                        </td>
                        <td class="table-box__item">{{ printCardValue.visitor ? printCardValue.visitor.firm.title : '' }}</td>
                    </tr>

                    <tr>
                        <td class="table-box__item table-box__item_w50">
                            <h3 class="table-box__item-head">Контактное лицо:</h3>
                            <small>(со стороны ООО "КЛААС")</small>
                        </td>
                        <td class="table-box__item">{{ printCardValue.visitor ? getShortName(printCardValue.employee) : '' }}</td>
                    </tr>
                </table>

                <div class="warning-message">
                    <h3 class="warning-message__text">Внимание!</h3>
                    <p class="warning-message__text">Ознакомьтесь с правилами пребывания на предприятии</p>
                    <small>(на обратной стороне бланка)</small>
                    <img class="warning-message__img" src="@/assets/printCard/signs.png" /> 
                </div>

        
                <table class="table-box">
                    <tr>
                        <th class="table-box__item" colspan=2>с правилами ознакомлен</th>
                    </tr>
                    <tr>
                        <th class="table-box__item table-box__item_w50">Дата</th>
                        <th class="table-box__item">Подпись водителя</th>
                    </tr>
                    <tr>
                        <td class="table-box__item table-box__item_center table-box__item_w50">{{ printCardValue.inTime ? $moment(printCardValue.inTime).format('DD.MM.YYYY') : '' }}</td>
                        <td class="table-box__item"></td>
                    </tr>
                </table>

            </div>

            <div class="right-part">
                <table class="table-box">
                    <tr>
                        <th class="table-box__item" colspan=2>Прибытие</th>
                    </tr>

                    <tr>
                        <td class="table-box__item table-box__item_w50">Дата</td>
                        <td class="table-box__item">{{ printCardValue.inTime ? $moment(printCardValue.inTime).format('DD.MM.YYYY') : '' }}</td>
                    </tr>

                    <tr>
                        <td class="table-box__item table-box__item_w50">Время</td>
                        <td class="table-box__item">{{ printCardValue.inTime ? $moment(printCardValue.inTime).format('HH:mm') : '' }}</td>
                    </tr>

                    <tr>
                        <td class="table-box__item table-box__item_w50">Ф.И.О. сотрудника охраны</td>
                        <td class="table-box__item">{{ printCardValue.visitor ? getShortName(printCardValue.security) : '' }}</td>
                    </tr>
                </table>

                <table class="table-box">
                    <tr>
                        <th class="table-box__item" colspan=2>Отметки сотрудника охраны</th>
                    </tr>
                    <tr>
                        <td class="table-box__item table-box__item_w50">Время убытия</td>
                        <td class="table-box__item"></td>
                    </tr>
                    <tr>
                        <td class="table-box__item table-box__item_w50">Ф.И.О. сотрудника охраны</td>
                        <td class="table-box__item"></td>
                    </tr>
                </table>

                <table class="table-box">
                    <caption class="table-box__caption">Отметки сотрудника ООО "КЛААС"</caption>
                    <tr>
                        <td class="table-box__item table-box__item_w50">Место выгрузки:</td>
                        <td class="table-box__item"></td>
                    </tr>
                    <tr>
                        <td class="table-box__item table-box__item_w50">Груз, количество мест:</td>
                        <td class="table-box__item"></td>
                    </tr>
                    <tr>
                        <td class="table-box__item table-box__item_w50">Разгрузку осуществил:</td>
                        <td class="table-box__item"></td>
                    </tr>
                </table>


                <table class="table-box">
                    <tr>
                        <td class="table-box__item table-box__item_w50">Время убытия</td>
                        <td class="table-box__item"></td>
                    </tr>
                    <tr>
                        <td class="table-box__item table-box__item_w50">Ф.И.О. сотрудника<br/>ООО "КЛААС"</td>
                        <td class="table-box__item"></td>
                    </tr>
                    <tr>
                        <td class="table-box__item table-box__item_w50">Подпись</td>
                        <td class="table-box__item"></td>
                    </tr>
                </table>
            </div>
        </div>
      </div>

      <div class="page second-page">
        <div class="page-container">
          <div class="left-part">
            <h2 class="second-page__head">Пожалуйста, соблюдайте правила пребывания на территории предприятия:</h2>
            <ul>
              <li class="second-page__list-item">Следуйте правилам безопасности, с которыми Вас ознакомили сотрудники охраны;</li>
              <li class="second-page__list-item">Транспортные средства ООО «КЛААС» имеют право преимущественного проезда;</li>
              <li class="second-page__list-item">Передвижение по территории только в сопровождении или по маршруту, указанному сотрудником  ООО «КЛААС»;</li>
              <li class="second-page__list-item">Парковка разрешена только в специально отведенных местах;</li>
              <li class="second-page__list-item">Запрещен доступ на территорию зоны таможенного контроля, отмеченной соответствующим знаком;</li>
              <li class="second-page__list-item">Запрещены фото- и видеосъемка;</li>
              <li class="second-page__list-item">Запрещено курение, за исключением специально отведенных мест;</li>
              <li class="second-page__list-item">На территории ООО «КЛААС» водителю разрешено находиться строго в специальной защитной обуви с закрытым носком и пяткой;</li>
              <li class="second-page__list-item">Перемещаться по территории завода только в сопровождении сотрудника ООО «КЛААС» или строго по указанному сотрудником охраны маршруту;</li>
              <li class="second-page__list-item">Сотрудники охраны могут произвести осмотр транспортных средств, сумок и других имеющихся при себе вещей.</li>
            </ul>
          </div>

          <div class="right-part">
            <img class="location-map" src="@/assets/printCard/carMap.jpg" />
          </div>
        </div>
      </div>
    </div>
  </FullscreenModalLayout>
</template>

<script>
import FullscreenModalLayout from "@/components/app/modals/FullscreenModalLayout"
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
      await this.$htmlToPaper('print_car_card');
    },

    getShortName(person) {
      return peopleHelper.getShortName(person)
    }
  },

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
    .no-print, .no-print * {
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
        font-size: 16px;
    }

    .second-page__list-item {
        margin-top: 1mm;
        font-size: 12px;
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
        width: 50mm;;
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