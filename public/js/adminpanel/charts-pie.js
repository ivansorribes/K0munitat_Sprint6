// /**
//  * For usage, visit Chart.js docs https://www.chartjs.org/docs/latest/
//  */
const pieConfig = {
  type: 'doughnut',
  data: {
    datasets: [
      {
        data: [23, 29, 12],
        /**
         * These colors come from Tailwind CSS palette
         * https://tailwindcss.com/docs/customizing-colors/#default-color-palette
         */
        backgroundColor: ['#10b981', '#0d9488', '#3b82f6', '#4f46e5', '#9333ea', '#a21caf'],
        label: 'Dataset 1',
      },
    ],
    labels: ['Vegetables', 'Tools', 'Other'],
  },
  options: {
    responsive: true,
    cutoutPercentage: 80,
    /**
     * Default legends are ugly and impossible to style.
     * See examples in charts.html to add your own legends
     *  */
    legend: {
      display: false,
    },
  },
}

// // change this to the id of your chart element in HMTL
const pieCtx = document.getElementById('pie')
window.myPie = new Chart(pieCtx, pieConfig)

// Realiza una solicitud AJAX para obtener los recuentos de posts por categoría desde el backend
function fetchPostCountsByCategory() {
  return fetch('/post-count-by-category')
    .then(response => {
      if (!response.ok) {
        throw new Error('Error al obtener los datos de recuento de posts por categoría');
      }
      return response.json();
    })
    .catch(error => {
      console.error('Error:', error);
    });
}

// Función para actualizar los datos del gráfico de Chart.js con los recuentos de posts por categoría
async function updatePieChart() {
  try {
    const postCounts = await fetchPostCountsByCategory();
    const counts = Object.values(postCounts);
    const labels = Object.keys(postCounts);

    // Actualiza los datos del gráfico con los recuentos de posts y las etiquetas de las categorías
    window.myPie.data.datasets[0].data = counts;
    window.myPie.data.labels = labels;

    // Actualiza el gráfico
    window.myPie.update();
  } catch (error) {
    console.error('Error al actualizar el gráfico:', error);
  }
}

// Llama a la función para actualizar el gráfico cuando se carga la página
document.addEventListener('DOMContentLoaded', function () {
  updatePieChart();
});
