// Configuración del gráfico de líneas
const lineConfig = {
  type: 'line',
  data: {
    labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
    datasets: [
      {
        label: 'Users',
        fill: false,
        /**
         * These colors come from Tailwind CSS palette
         * https://tailwindcss.com/docs/customizing-colors/#default-color-palette
         */
        backgroundColor: '#7e3af2',
        borderColor: '#7e3af2',
        data: [], // El recuento de usuarios por mes se agregará aquí
      },
    ],
  },
  options: {
    responsive: true,
    legend: {
      display: false,
    },
    tooltips: {
      mode: 'index',
      intersect: false,
    },
    hover: {
      mode: 'nearest',
      intersect: true,
    },
    scales: {
      x: {
        display: true,
        scaleLabel: {
          display: true,
          labelString: 'Month',
        },
      },
      y: {
        display: true,
        scaleLabel: {
          display: true,
          labelString: 'User Count',
        },
      },
    },
  },
};

// Obtener el recuento de usuarios por mes mediante fetch
fetch('/user-count-by-month')
  .then(response => {
    if (!response.ok) {
      throw new Error('Error fetching user count by month');
    }
    return response.json();
  })
  .then(data => {
    // Agregar el recuento de usuarios por mes al gráfico
    lineConfig.data.datasets[0].data = data;
    // Crear el gráfico con los datos actualizados
    const lineCtx = document.getElementById('line');
    window.myLine = new Chart(lineCtx, lineConfig);
  })
  .catch(error => {
    console.error('Error fetching user count by month:', error);
  });
