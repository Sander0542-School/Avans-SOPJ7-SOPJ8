window.ChangeFilter = {
    dateSort: 0,
    orderIcons: ['fa-caret-down', 'fa-caret-up', 'fa-sort'],
    FilterBy: {
        date: () => {
            let sortStatus = ChangeFilter.dateSort;
            let table = document.getElementById('layerTable');
            let headers = table.querySelectorAll('thead > tr > th');
            let dateHeader = headers[headers.length - 1];
            let icon = dateHeader.querySelector('.fas');
            let nodeRows = table.querySelectorAll('tbody > tr');

            let rows;
            switch (sortStatus) {
                case 0:
                    rows = ChangeFilter.FilterBy.orderDates(nodeRows, sortStatus);
                    ChangeFilter.FilterBy.changeTable(table, nodeRows, rows);
                    icon.classList.remove(ChangeFilter.orderIcons[2])
                    icon.classList.add(ChangeFilter.orderIcons[sortStatus])
                    ChangeFilter.dateSort++;
                    break;
                case 1:
                    rows = ChangeFilter.FilterBy.orderDates(nodeRows, sortStatus);
                    ChangeFilter.FilterBy.changeTable(table, nodeRows, rows);
                    icon.classList.remove(ChangeFilter.orderIcons[0]);
                    icon.classList.add(ChangeFilter.orderIcons[sortStatus]);
                    ChangeFilter.dateSort++;
                    break;
                case 2:
                    icon.classList.remove(ChangeFilter.orderIcons[1]);
                    icon.classList.add(ChangeFilter.orderIcons[sortStatus]);
                    ChangeFilter.dateSort = 0;
                    break;
            }

        },
        orderDates: (nodes, operation) => {
            let array = Array.prototype.slice.call(nodes, 0);

            array.sort((a, b) => {
                let c = new Date(a.querySelector('#date').innerText);
                let d = new Date(b.querySelector('#date').innerText);
                if (operation === 0)
                    return d - c;
                if (operation === 1)
                    return c - d;
            });

            return array
        },
        changeTable: (table, nodes, rows) => {
            nodes.forEach(n => table.querySelector('tbody').removeChild(n));
            rows.forEach(tr => table.querySelector('tbody').appendChild(tr));
        },
    }
}

