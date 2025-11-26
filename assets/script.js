document.addEventListener('DOMContentLoaded',()=>{
 document.querySelectorAll('.delete-btn').forEach(btn=>{
  btn.addEventListener('click',e=>{
   if(!confirm('Are you sure you want to delete this record?')) e.preventDefault();
  });
 });
});

/* ===========================
   DASHBOARD BACKGROUND
=========================== */
.dashboard-background {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: url("assets/images/adfc_bg.jpg") no-repeat center center/cover;
    filter: blur(6px) brightness(60%);
    z-index: -1;
}

/* ===========================
   DASHBOARD CONTAINER
=========================== */
.dashboard-container {
    margin-top: 40px;
    text-align: center;
    color: white;
}

/* ===========================
   LOGO + HEADER
=========================== */
.adfc-logo {
    width: 120px;
    filter: drop-shadow(0 4px 8px rgba(0,0,0,0.4));
}

.dashboard-header h1 {
    margin-top: 10px;
    font-size: 34px;
    font-weight: 700;
}

.dashboard-header p {
    font-size: 18px;
    opacity: 0.9;
}

/* ===========================
   DASHBOARD BUTTONS
=========================== */
.grid {
    margin-top: 40px;
    display: flex;
    justify-content: center;
    gap: 20px;
    flex-wrap: wrap;
}

.card-link {
    background: rgba(255,255,255,0.18);
    backdrop-filter: blur(8px);
    padding: 20px 30px;
    font-size: 18px;
    border-radius: 15px;
    text-decoration: none;
    color: white;
    border: 1px solid rgba(255,255,255,0.25);
    width: 260px;
    text-align: center;
    font-weight: 600;
    transition: 0.2s;
}

.card-link:hover {
    background: rgba(255,255,255,0.3);
    transform: translateY(-4px);
}
