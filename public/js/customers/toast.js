

    function toastFlashMsg(type, msg) {
        let icon, title, color, iconColor;

        if (type === 'success') {
            icon = 'success';
            title = msg;
            color = '#3498DB';
            iconColor = '#58D68D';
        } else if (type === 'error') {
            icon = 'error';
            title = msg;
            color = '#E74C3C';
            iconColor = '#FF0000';
        } else if (type === 'warning') {
            icon = 'warning';
            title = msg;
            color = '#F1C40F';
            iconColor = '#F39C12';
        } else if (type === 'info') {
            icon = 'info';
            title = msg;
            color = '#3498DB';
            iconColor = 'Blue';
        } else if (type === 'question') {
            icon = 'question';
            title = msg;
            color = '#3498DB';
            iconColor = 'Blue';
        }

        Swal.fire({
            position: "top-end",
            iconColor: iconColor,
            icon: icon,
            color: color,
            toast: true,
            title: title,
            showConfirmButton: false,
            timer: 2000
        });
    }

    

