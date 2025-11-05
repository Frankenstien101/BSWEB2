<style>
    body {
        background-color: #f8fafc;
        font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
        padding: 20px;
    }

    .cards-container {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 20px;
    }

    .card {
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        padding: 15px 20px;
        transition: all 0.3s ease;
    }

    .card:hover {
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .card-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 10px;
    }

    .card-title {
        font-size: 18px;
        font-weight: 700;
        color: #2c3e50;
    }

    .beat-label {
        font-size: 13px;
        color: #777;
    }

    .status-badge {
        display: inline-block;
        padding: 4px 10px;
        border-radius: 6px;
        font-size: 12px;
        font-weight: 600;
        color: white;
    }

    .status-online {
        background-color: #27ae60;
    }

    .status-offline {
        background-color: #7f8c8d;
    }

    .visited-box {
        background-color: #3b82f6;
        color: white;
        font-weight: 700;
        font-size: 18px;
        border-radius: 10px;
        padding: 6px 12px;
        display: inline-block;
        text-align: center;
        min-width: 70px;
    }

    .visited-box small {
        display: block;
        font-size: 12px;
        font-weight: 500;
        margin-top: 2px;
        opacity: 0.8;
    }

    .metrics {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 8px;
        margin-top: 10px;
        font-size: 13px;
        text-align: center;
    }

    .metric-group {
        background: #f9fafb;
        border-radius: 6px;
        padding: 8px 5px;
    }

    .metric-label {
        color: #777;
        font-size: 12px;
    }

    .metric-value {
        font-size: 15px;
        font-weight: 600;
        color: #2c3e50;
        margin-top: 2px;
    }

    .divider {
        height: 1px;
        background-color: #eee;
        margin: 10px 0;
    }

    .footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 12px;
        color: #777;
        margin-top: 6px;
    }

    .footer strong {
        color: #2c3e50;
    }
</style>

<div class="cards-container">
    <div class="card">
        <div class="card-header">
            <div>
                <div class="card-title">DVO KV9-A</div>
                <div class="beat-label">Beat: 1</div>
                <span class="status-badge status-online">Online</span>
            </div>
            <div class="visited-box">
                34/70
                <small>Visited</small>
            </div>
        </div>

        <div class="metrics">
            <div class="metric-group">
                <div class="metric-label">Distance</div>
                <div class="metric-value">118.8 km</div>
                <div class="metric-label">Market: 60.4 km</div>
            </div>
            <div class="metric-group">
                <div class="metric-label">Market Timing</div>
                <div class="metric-value">08:17</div>
                <div class="metric-label">Entry - Exit</div>
            </div>
            <div class="metric-group">
                <div class="metric-label">Time Spent</div>
                <div class="metric-value">3h 45m</div>
                <div class="metric-label">In Store</div>
            </div>
        </div>

        <div class="divider"></div>

        <div class="footer">
            <div>Productivity: <strong>-- / 70</strong></div>
            <div>Achieved Target</div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <div>
                <div class="card-title">DVO KAE-1</div>
                <div class="beat-label">Beat: 1</div>
                <span class="status-badge status-offline">Offline</span>
            </div>
            <div class="visited-box">
                0/0
                <small>Visited</small>
            </div>
        </div>

        <div class="metrics">
            <div class="metric-group">
                <div class="metric-label">Distance</div>
                <div class="metric-value">0.0 km</div>
                <div class="metric-label">Market: 0.0 km</div>
            </div>
            <div class="metric-group">
                <div class="metric-label">Market Timing</div>
                <div class="metric-value">-</div>
                <div class="metric-label">Entry - Exit</div>
            </div>
            <div class="metric-group">
                <div class="metric-label">Time Spent</div>
                <div class="metric-value">0h 0m</div>
                <div class="metric-label">In Store</div>
            </div>
        </div>

        <div class="divider"></div>

        <div class="footer">
            <div>Productivity: <strong>-- / 0</strong></div>
            <div>Achieved Target</div>
        </div>
    </div>
</div>
