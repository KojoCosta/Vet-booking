

<?php $__env->startSection('content'); ?>
  <main class="container-fluid py-4">
    
    <div class="row g-4 mb-4">
      <div class="col-6 col-md-3">
        <div class="card stats-card users h-100 border-0">
          <div class="card-body">
            <i class="bx bx-user-circle text-primary fs-1 me-3"></i>
            <div>
              <h6 class="mb-1 text-primary">Users</h6>
              <h3 class="fw-bold mb-0"><?php echo e($userCount); ?></h3>
            </div>
          </div>
        </div>
      </div>

      <div class="col-6 col-md-3">
        <div class="card stats-card pets h-100 border-0">
          <div class="card-body">
            <i class="bx bx-data text-success fs-1 me-3"></i>
            <div>
              <h6 class="mb-1 text-success">Pets</h6>
              <h3 class="fw-bold mb-0"><?php echo e($petCount); ?></h3>
            </div>
          </div>
        </div>
      </div>

      <div class="col-6 col-md-3">
        <div class="card stats-card appointments h-100 border-0">
          <div class="card-body">
            <i class="bx bx-calendar-check text-warning fs-1 me-3"></i>
            <div>
              <h6 class="mb-1 text-warning">Appointments</h6>
              <h3 class="fw-bold mb-0"><?php echo e($appointmentCount); ?></h3>
            </div>
          </div>
        </div>
      </div>

      <div class="col-6 col-md-3">
        <div class="card stats-card reactions h-100 border-0">
          <div class="card-body">
            <i class="bx bx-chat text-danger fs-1 me-3"></i>
            <div>
              <h6 class="mb-1 text-danger">Pending Reactions</h6>
              <h3 class="fw-bold mb-0"><?php echo e($reactionCount); ?></h3>
            </div>
          </div>
        </div>
      </div>
    </div>

    
    <div class="row g-4">
      <div class="col-lg-6">
        <div class="card h-100 border-0">
          <div class="card-header bg-warning-subtle text-warning fw-semibold">
            Monthly Appointments
          </div>
          <div class="card-body">
            <canvas id="appointmentsChart" height="150"></canvas>
          </div>
        </div>
      </div>

      <div class="col-lg-6">
        <div class="card h-100 border-0">
          <div class="card-header bg-info-subtle text-info fw-semibold">
            User Sign-ups
          </div>
          <div class="card-body">
            <canvas id="userGrowthChart" height="150"></canvas>
          </div>
        </div>
      </div>
    </div>
  </main>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
<script>
    document.addEventListener('DOMContentLoaded', () => {
      const labels   = <?php echo json_encode($monthLabels, 15, 512) ?>;
      const apptData = <?php echo json_encode($appointmentChart, 15, 512) ?>;
      const userData = <?php echo json_encode($userChart, 15, 512) ?>;

      // Appointments line chart with blue gradient
      const ctxA = document.getElementById('appointmentsChart').getContext('2d');
      const gradA = ctxA.createLinearGradient(0,0,0,150);
      gradA.addColorStop(0, 'rgba(78,115,223,0.4)');
      gradA.addColorStop(1, 'rgba(78,115,223,0.1)');

      new Chart(ctxA, {
        type: 'line',
        data: {
          labels,
          datasets: [{
            label: 'Appointments',
            data: apptData,
            borderColor: '#4e73df',
            backgroundColor: gradA,
            fill: true,
            tension: 0.4,
            pointBackgroundColor: '#4e73df'
          }]
        },
        options: { responsive: true }
      });

      // User sign-ups bar chart with green gradient
      const ctxU = document.getElementById('userGrowthChart').getContext('2d');
      const gradU = ctxU.createLinearGradient(0,0,0,150);
      gradU.addColorStop(0, 'rgba(28,200,138,0.4)');
      gradU.addColorStop(1, 'rgba(28,200,138,0.1)');

      new Chart(ctxU, {
        type: 'bar',
        data: {
          labels,
          datasets: [{
            label: 'New Users',
            data: userData,
            backgroundColor: gradU,
            borderColor: '#1cc88a',
            borderWidth: 1
          }]
        },
        options: {
          responsive: true,
          scales: { y: { beginAtZero: true } }
        }
      });
    });
  </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('dashboard.admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\vet-booking\resources\views/dashboard/admin/index.blade.php ENDPATH**/ ?>