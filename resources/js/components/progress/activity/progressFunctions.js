export default {
    methods: {
        calculateStatus(progressInstance) {
            let incompleted = this.calculateIncomplete(progressInstance).length;
            let completed = this.calculateComplete(progressInstance).length;
            if (incompleted === 0 && completed > 0) {
                return 'Finished';
            } else if (incompleted === 0 && completed === 0) {
                return 'N/A';
            } else if (incompleted > 0 && completed === 0) {
                return 'Not started';
            } else if (incompleted > 0 && completed > 0) {
                return 'In progress';
            }
            return 'N/A';
        },

        calculatePercentage(progressInstance) {
            let incompleted = this.calculateIncomplete(progressInstance).length;
            let completed = this.calculateComplete(progressInstance).length;
            if (incompleted + completed === 0) {
                return 'N/A';
            }
            return Math.round((completed / (incompleted + completed)) * 100);
        },

        calculateCompleteText(progressInstance) {
            let filteredModules = this.calculateComplete(progressInstance);
            if (filteredModules.length > 0) {
                return '<ul>' +
                    filteredModules.map(moduleInstance => '<li style="color: ' + (moduleInstance.evaluation.mandatory === true ? '#ff8370' : 'black') + '">' + moduleInstance.name + '</li>').join('')
                    + '</ul>';
            }
            return '';
        },

        calculateIncompleteText(progressInstance) {
            let filteredModules = this.calculateIncomplete(progressInstance);
            if (filteredModules.length > 0) {
                return '<ul>' +
                    filteredModules.map(moduleInstance => '<li style="color: ' + (moduleInstance.evaluation.mandatory === true ? '#ff8370' : 'black') + '">' + moduleInstance.name + '</li>').join('')
                    + '</ul>';
            }
            return '';
        },

        calculateComplete(progressInstance) {
            return progressInstance.module_instances.filter(moduleInstance => moduleInstance.evaluation.complete === true);
        },

        calculateIncomplete(progressInstance) {
            return progressInstance.module_instances.filter(moduleInstance => moduleInstance.evaluation.complete === false);
        },
    }
}
