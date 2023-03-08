Alpine.data("serviceQuickHeader", function () {
    return {
        quickAccessCondition: "reservation",
        descriptionBoxTop: 0,
        reservationBoxTop: 0,
        sessionsBoxTop: 0,
        staffsBoxTop: 0,
        portfolioBoxTop: 0,
        commentBoxTop: 0,
        scrollContoroller: function (a) {
            window.scrollTo({top: a - 80, left: 0, behavior: "smooth"})
        },
        scrollingController: function () {
            switch (!0) {
                case window.pageYOffset >= this.reservationBoxTop && window.pageYOffset <= this.descriptionBoxTop:
                    this.quickAccessCondition = "reservation";
                    break;
                case window.pageYOffset >= this.descriptionBoxTop && window.pageYOffset <= this.sessionsBoxTop:
                    this.quickAccessCondition = "description";
                    break;
                case window.pageYOffset >= this.sessionsBoxTop && window.pageYOffset <= this.staffsBoxTop:
                    this.quickAccessCondition = "sessions";
                    break;
                case window.pageYOffset >= this.staffsBoxTop && window.pageYOffset <= this.portfolioBoxTop:
                    this.quickAccessCondition = "staffs";
                    break;
                case window.pageYOffset >= this.portfolioBoxTop && window.pageYOffset <= this.commentBoxTop:
                    this.quickAccessCondition = "portfolio";
                    break;
                case window.pageYOffset >= this.commentBoxTop:
                    this.quickAccessCondition = "comment";
                    break;
                default:
                    this.quickAccessCondition = "reservation"
            }
        }
    }
})