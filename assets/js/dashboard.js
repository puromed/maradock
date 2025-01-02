document.addEventListener('DOMContentLoaded', function(){
    const priorityStyles = {
        high: {
            class: 'bg-danger',
            text: 'High Priority'
        },
        medium: {
            class: 'bg-warning',
            text: 'Medium Priority'
        },
        low: {
            class: 'bg-success',
            text: 'Low Priority'
        }
    };

    const priorityOptions = document.querySelectorAll('.priority-option');

    priorityOptions.forEach(option => {
        option.addEventListener('click', function(e){
            console.log('Priority option clicked'); // Debugging
            e.preventDefault();
            e.stopPropagation();

            const priority = this.dataset.priority;
            console.log('Selected priority:', priority); // Debugging

            const badge = this.closest('.dropdown').querySelector('.badge');
            console.log('Current badge classes: ', badge.classList); // Debugging

            //Remove all priority classes
            Object.values(priorityStyles).forEach(style => {
                badge.classList.remove(style.class);
            });

            // Add new class
            badge.classList.add(priorityStyles[priority].class);
            badge.textContent = priorityStyles[priority].text;

            console.log('Updated badge classes: ', badge.classList); // Debugging

            //close dropdown using bootstrap 5 api
            const dropdown = bootstrap.dropdown.getInstance(badge);
            if (dropdown) {
                dropdown.hide();
            }
        });
    });
});



/*attendance, assignment, and participation chart*/
document.addEventListener('DOMContentLoaded', function() {
    // Common options for all donut charts
    const commonOptions = {
        chart: {
            type: 'donut',
            height: 250
        },
        legend: {
            position: 'bottom'
        },
        responsive: [{
            breakpoint: 480,
            options: {
                chart: {
                    height: 200
                }
            }
        }],
        plotOptions: {
            pie: {
                donut: {
                    size: '70%'
                }
            }
        }
    };

    // Assignment Chart
    const assignmentChart = new ApexCharts(document.querySelector("#assignmentChart"), {
        ...commonOptions,
        colors: ['#00c6fb', '#005bea'],
        series: [85, 15],
        labels: ['Completed', 'Pending'],
    });
    assignmentChart.render();

    // Attendance Chart
    const attendanceChart = new ApexCharts(document.querySelector("#attendanceChart"), {
        ...commonOptions,
        colors: ['#4ade80', '#16a34a'],
        series: [90, 10],
        labels: ['Present', 'Absent'],
    });
    attendanceChart.render();

    // Participation Chart
    const participationChart = new ApexCharts(document.querySelector("#participationChart"), {
        ...commonOptions,
        colors: ['#a855f7', '#7e22ce'],
        series: [75, 25],
        labels: ['Active', 'Inactive'],
    });
    participationChart.render();

    // Update charts on theme change
    document.addEventListener('themeChanged', function() {
        const isDark = document.documentElement.getAttribute('data-bs-theme') === 'dark';
        [assignmentChart, attendanceChart, participationChart].forEach(chart => {
            chart.updateOptions({
                theme: {
                    mode: isDark ? 'dark' : 'light'
                }
            });
        });
    });
});

// gpa chart
document.getElementById('subjectCount').addEventListener('change', function() {
    const subjectCount = parseInt(this.value);
    const marksContainer = document.getElementById('marksContainer');
    marksContainer.innerHTML = ''; // Clear previous marks

    // create input fields for marks
    for (let i = 0; i < subjectCount; i++) {
        const input = document.createElement('input');
        input.type = 'number';
        input.placeholder = `Enter marks for subject ${i + 1}`;
        input.className = 'form-control mb-2';
        input.min = '0';
        input.max = '100';
        input.id = `mark${i + 1}`;
        marksContainer.appendChild(input);
    }
});

document.getElementById('gpaSubmit').addEventListener('click', function() {
    const subjectCount = parseInt(document.getElementById('subjectCount').value);
    let totalMarks = 0;

    // Calculate total marks
    for (let i = 0; i < subjectCount; i++) {
        const mark = parseFloat(document.getElementById(`mark${i + 1}`).value);
        if (isNaN(mark) || mark < 0 || mark > 100) {
            alert(`Please enter a valid marks between 0 and 100 for each subject`);
            return;
        }
        totalMarks += mark;
    }

    // Calculate GPA
    const averageMarks = totalMarks / subjectCount;
    const gpaValue = (averageMarks / 100) * 4; 

    // **Change the chart type to 'bar' and update options**
    const options = {
        chart: {
            type: 'bar', // Use a bar chart for GPA representation
            height: 350,
            toolbar: {
              show: false, //hide the toolbar
            }
        },
        series: [{
            name: 'GPA',
            data: [gpaValue] // GPA value in the data array
        }],
        plotOptions: {
            bar: {
                horizontal: true, // Horizontal bar chart
                dataLabels: {
                    position: 'top', // Put labels above the bar
                },
            }
        },
        dataLabels: {
            enabled: true,
            offsetX: -6,
            style: {
                fontSize: '12px',
                colors: ['#C4D6B0'] // White color for labels
            },
            formatter: function (val) {
              return val.toFixed(2); // Display GPA with 2 decimal places
            }
        },
        title: {
            text: 'Your GPA',
            align: 'center',
            style: {
                fontSize: '24px',
                color: '#C4D6B0'
            }
        },
        xaxis: {
            categories: ['GPA'], // Label for the x-axis
            range: [0, 4], // Set the x-axis range from 0 to 4
            labels: {
              style: {
                colors: '#C4D6B0', // White color for x-axis labels
              },
            },
        },
        yaxis: {
          labels: {
            style: {
              colors: '#C4D6B0', // White color for y-axis labels
            },
          },
        },
        fill: {
            colors: ['#4ade80'] // Green color for the bar
        },
        tooltip: {
          enabled: false, // Disable tooltips if you don't need them
        }
    };

    if (window.gpaChart && typeof window.gpaChart.destroy === 'function') {
        window.gpaChart.destroy();
    }
    
    // Render the chart
    window.gpaChart = new ApexCharts(document.querySelector("#gpaChart"), options);
    window.gpaChart.render();
});