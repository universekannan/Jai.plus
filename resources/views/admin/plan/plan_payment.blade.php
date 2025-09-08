<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8" />
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <title>Send Polygon USDT to Multiple Recipients</title>
  <style>
    body { font-family: Arial, sans-serif; padding: 20px; background: #f5f5f5; }
    .container { max-width: 720px; margin: 0 auto; background: #fff; padding: 20px; border-radius: 12px; box-shadow: 0 2px 12px rgba(0,0,0,0.08); }
    h2 { text-align: center; color: #222; margin-bottom: 18px; }
    .recipients { background: #f8f9fa; padding: 14px; border-radius: 10px; margin-bottom: 16px; }
    .recipient { margin: 8px 0; padding: 10px; background: white; border-radius: 6px; border-left: 4px solid #007bff; }
    button { width: 100%; padding: 14px; font-size: 16px; background: #007bff; color: white; border: none; border-radius: 10px; cursor: pointer; margin: 8px 0; }
    button:hover { background: #0056b3; }
    button:disabled { background: #6c757d; cursor: not-allowed; }
    .status { margin-top: 16px; padding: 12px; border-radius: 10px; font-size: 14px; }
    .loading { background: #fff3cd; color: #856404; border: 1px solid #ffeaa7; }
    .success { background: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
    .error { background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
    .warning { background: #fff3cd; color: #856404; border: 1px solid #ffe8a1; }
    .info { background: #d1ecf1; color: #0c5460; border: 1px solid #bee5eb; }
    .progress { width: 100%; background: #f0f0f0; border-radius: 10px; margin: 10px 0; overflow: hidden; }
    .progress-bar { height: 24px; background: linear-gradient(45deg, #007bff, #0056b3); width: 0%; border-radius: 10px; transition: width 0.4s ease; text-align: center; color: white; line-height: 24px; font-size: 13px; font-weight: bold; }
    .transaction-details { background: #f8f9fa; border: 1px solid #dee2e6; border-radius: 8px; padding: 12px; margin: 10px 0; }
    .detail-row { display: flex; justify-content: space-between; margin: 6px 0; padding: 4px 0; border-bottom: 1px dotted #ddd; }
    .detail-row:last-child { border-bottom: none; }
    .detail-label { font-weight: 600; color: #555; }
    .detail-value { color: #333; word-break: break-all; }
    .tx-hash-link { color: #007bff; text-decoration: none; }
    .tx-hash-link:hover { text-decoration: underline; }
    .summary-box { background: linear-gradient(135deg, #007bff, #0056b3); color: white; padding: 18px; border-radius: 10px; text-align: center; margin: 16px 0; }
    .summary-stat { display: inline-block; margin: 0 16px; font-size: 15px; }
    .summary-stat strong { display: block; font-size: 22px; margin-bottom: 4px; }
  </style>
</head>
<body>
  <div class="container">
    <h2>🚀 Batch USDT Transfer on Polygon (Trust Wallet) {{ $userId ?? '' }}</h2>

    @php
      // Expect these to be passed in from the route/controller: $plan, $adminwallet, $refwallet, $userId
      $planAmount      = $plan->plan_amount;         // total USDT to send
      $planAmountSplit = $plan->plan_amount / 2;     // 50/50 split

      // $nums = preg_replace('/\D/', '', $adminwallet->wallet_address);
      // $shortwallet1 = substr($nums, 0, 4) . '...' . substr($nums, -4);

      // $nums = preg_replace('/\D/', '', $refwallet->wallet_address);
      // $shortwallet2 = substr($nums, 0, 4) . '...' . substr($nums, -4);
    @endphp

    <div class="recipients">
      <h3>📍 Recipients & Amounts:</h3>
      <div class="recipient">
        <strong>🏪 {{ $adminwallet->name }}:</strong> {{ $adminwallet->wallet_address }}<br>
        <strong>💰 Amount:</strong> {{ $planAmountSplit }} USDT
      </div>
      <div class="recipient">
        <strong>🏪 {{ $refwallet->name }}:</strong> {{ $refwallet->wallet_address }}<br>
        <strong>💰 Amount:</strong> {{ $planAmountSplit }} USDT
      </div>
      <div style="text-align: center; margin-top: 12px; font-weight: bold; color: #007bff; font-size: 18px;">
        💎 Total: {{ $planAmount }} USDT
      </div>
    </div>

    <div class="progress" id="progressContainer" style="display:none;">
      <div class="progress-bar" id="progressBar">Preparing...</div>
    </div>

    <button id="sendBtn">🚀 Send via Trust Wallet</button>

    <div id="status" class="status info">
      🔥 This page will open Trust Wallet (if needed) and prompt you to confirm <b>2 USDT transfers on Polygon</b>. No full ABI is used — only raw function selectors.
    </div>
  </div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script>
    // =============================
    // CONFIG
    // =============================
    const tokenAddress = "0xc2132D05D31c914a87C6611C10748AEb04B58e8F"; // USDT (Polygon)
    const polygonChainId = '0x89'; // 137
    const pageUrl = window.location.href;
    // Deep link will open the app; the in-app DApp browser will inject window.ethereum
    const trustDeepLink = `https://link.trustwallet.com/open_url?url=${encodeURIComponent(pageUrl)}`;

    // ====== RECIPIENTS FROM BLADE ======
    const planId   = "{{ $plan->id }}";
    const userId   = "{{ $userId }}";
    const splitAmt = Number("{{ $planAmountSplit }}");
    const totalAmt = Number("{{ $planAmount }}");
    // USDT has 6 decimals
    const usdtAtomicStr = (splitAmt * 1e6).toFixed(0); // string, safe for big numbers

    const recipients = [
      { id: 1, address: "{{ $adminwallet->wallet_address }}", amount: usdtAtomicStr, displayAmount: "{{ $planAmountSplit }}", name: "{{ $adminwallet->name }}" },
      { id: 2, address: "{{ $refwallet->wallet_address }}",   amount: usdtAtomicStr, displayAmount: "{{ $planAmountSplit }}", name: "{{ $refwallet->name }}" }
    ];

    // ====== STATE ======
    let userAddress  = null;
    let transactionResults = [];
    let autoStarted = false;

    // =============================
    // LOW-LEVEL ENCODERS (no ABI)
    // =============================
    const selector = {
      transfer: '0xa9059cbb',       // transfer(address,uint256)
      balanceOf: '0x70a08231',      // balanceOf(address)
    };

    function strip0x(h){ return h.startsWith('0x') ? h.slice(2) : h; }
    function toHexBN(decStr){
      // dec string -> hex string (no 0x), supports big numbers
      let n = BigInt(decStr);
      return n.toString(16);
    }
    function pad32(hexStr){
      return hexStr.padStart(64, '0');
    }
    function encodeAddress(addr){
      return pad32(strip0x(addr).toLowerCase());
    }
    function encodeUint256(decStr){
      return pad32(toHexBN(decStr));
    }
    function encodeTransferData(to, amountDecStr){
      return selector.transfer + encodeAddress(to) + encodeUint256(amountDecStr);
    }
    function encodeBalanceOfData(owner){
      return selector.balanceOf + encodeAddress(owner);
    }

    // =============================
    // UI HELPERS
    // =============================
    function updateStatus(message, type='info') {
      const el = document.getElementById('status');
      el.className = `status ${type}`;
      el.innerHTML = message;
    }
    function updateProgress(current, total, message='') {
      const c = document.getElementById('progressContainer');
      const b = document.getElementById('progressBar');
      c.style.display = 'block';
      const pct = Math.max(0, Math.min(100, Math.round((current/total)*100)));
      b.style.width = pct + '%';
      b.textContent = message || `${pct}% (${current}/${total})`;
    }
    function hideProgress(){ document.getElementById('progressContainer').style.display='none'; }
    function formatAddr(a){ return `${a.slice(0,8)}...${a.slice(-6)}`; }

    // =============================
    // WALLET INIT (Trust Wallet / any EVM wallet)
    // =============================
    async function initWallet() {
      if (!window.ethereum) {
        updateStatus('📱 Opening Trust Wallet...', 'loading');
        window.location.href = trustDeepLink;
        throw new Error('No injected provider found. Opening Trust Wallet.');
      }

      updateStatus('🔗 Connecting to wallet...', 'loading');
      const accounts = await window.ethereum.request({ method: 'eth_requestAccounts' });
      if (!accounts || accounts.length === 0) throw new Error('No accounts from wallet');

      userAddress = accounts[0];

      // Ensure Polygon
      try {
        await window.ethereum.request({ method: 'wallet_switchEthereumChain', params: [{ chainId: polygonChainId }] });
      } catch (err) {
        if (err && err.code === 4902) {
          await window.ethereum.request({
            method: 'wallet_addEthereumChain',
            params: [{
              chainId: polygonChainId,
              chainName: 'Polygon Mainnet',
              nativeCurrency: { name: 'POL', symbol: 'POL', decimals: 18 },
              rpcUrls: ['https://polygon-rpc.com/'],
              blockExplorerUrls: ['https://polygonscan.com/']
            }]
          });
        } else {
          throw err;
        }
      }

      updateStatus(`✅ Connected: ${formatAddr(userAddress)} (Polygon)`, 'success');
      return { user: userAddress };
    }

    // =============================
    // HELPERS: On-chain calls (no ABI)
    // =============================
    async function ethCall(to, data){
      const res = await window.ethereum.request({ method: 'eth_call', params: [{ to, data }, 'latest'] });
      return res; // hex string 0x...
    }

    async function getUsdtBalance(addr){
      try {
        const data = encodeBalanceOfData(addr);
        const hex = await ethCall(tokenAddress, data);
        // parse uint256
        const bn = BigInt(hex);
        return bn; // in 6-decimals units
      } catch(e){
        return null;
      }
    }

    // =============================
    // SEND ONE TRANSFER (no ABI)
    // =============================
    async function sendUSDTTransfer(recipient) {
      try {
        const data = encodeTransferData(recipient.address, recipient.amount); // FIXED here ✅

        // Gas estimate (fallback if fails)
        let gasEstimate;
        try {
          gasEstimate = await window.ethereum.request({
            method: 'eth_estimateGas',
            params: [{ from: userAddress, to: tokenAddress, data, value: '0x0' }]
          });
        } catch (e) {
          // ~120k is plenty for USDT transfer on Polygon
          gasEstimate = '0x1d4c0'; // 120000
        }

        const gasLimitHex = (() => {
          try {
            const ge = BigInt(gasEstimate);
            const gl = (ge * 125n) / 100n; // +25%
            return '0x' + gl.toString(16);
          } catch {
            return '0x1fBD0'; // 130000
          }
        })();

        const txParams = {
          from: userAddress,
          to: tokenAddress,
          data,
          value: '0x0',
          gas: gasLimitHex,
        };

        // This ALWAYS requires user confirmation in-wallet
        const txHash = await window.ethereum.request({ method: 'eth_sendTransaction', params: [txParams] });
        return { success: true, txHash, gasUsed: gasEstimate, timestamp: new Date().toISOString() };
      } catch (error) {

        $.ajax({
          url: "{{ url('admin/transaction_history') }}",
          method: "POST",
          data: {
              plan_id: planId,
              user_id: userId,
              admin: 1,
              referral: {{ $refwallet->id }},
              amount: totalAmt,
              _token: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
          },
          success: function(res) {
              if (res.success) {
                  updateStatus('<div style="margin-top:10px;">Data Inserted</div>', 'success');
              } else {
                  updateStatus('<div style="margin-top:10px;">Insert failed.</div>', 'warning');
              }
          },
          error: function(xhr, exception) {
              console.log(xhr.responseText);
              updateStatus('<div style="margin-top:10px;">Ajax request failed.</div>', 'danger');
          }
      });

        return { success: false, error: (error && error.message) || 'Transaction failed', errorCode: error && error.code, timestamp: new Date().toISOString() };

      }
    }

    // =============================
    // BATCH FLOW
    // =============================
    async function runBatch(auto=false) {
      const btn = document.getElementById('sendBtn');
      btn.disabled = true;
      transactionResults = [];

      try {
        updateStatus(auto ? '🤖 Auto-start: initializing...' : '🔄 Initializing...', 'loading');
        updateProgress(0, recipients.length + 2, 'Connecting...');
        await initWallet();
        updateProgress(1, recipients.length + 2, 'Wallet connected');

        // Optional safety: balance check
        updateStatus('📦 Checking USDT balance...', 'loading');
        const bal = await getUsdtBalance(userAddress);
        if (bal === null) {
          updateStatus('⚠️ Could not read USDT balance. Proceeding without check.', 'warning');
        } else {
          const need = BigInt((totalAmt * 1e6).toFixed(0));
          if (bal < need) {
            updateStatus(`❌ Insufficient USDT. Need ${totalAmt} USDT, have ${Number(bal)/1e6} USDT.`, 'error');
            btn.disabled = false; return;
          }
        }
        updateProgress(2, recipients.length + 2, 'Balance OK');

        for (let i=0; i<recipients.length; i++) {
          const r = recipients[i];
          updateStatus(`📤 Sending ${r.displayAmount} USDT to ${r.name}...<br><small>Confirm in wallet.</small>`, 'loading');
          updateProgress(3 + i, recipients.length + 2, `Processing ${r.name}...`);

          const res = await sendUSDTTransfer(r);
          transactionResults.push({ recipient: r, ...res });

          if (res.success) {
            updateStatus(`✅ Sent to ${r.name}: <a class="tx-hash-link" target="_blank" href="https://polygonscan.com/tx/${res.txHash}">${res.txHash}</a>`, 'success');
          } else {
            if (res.errorCode === 4001) {
              updateStatus(`❌ You rejected the transaction for ${r.name}.`, 'error');
            } else {
              updateStatus(`❌ Failed for ${r.name}: ${res.error}`, 'error');
            }
          }

          if (i < recipients.length - 1) {
            await new Promise(r => setTimeout(r, 600));
          }
        }

        finalizeAndCallBackend();

      } catch (e) {
        hideProgress();
        const msg = (e && e.message) ? e.message : 'Batch failed to start';
        updateStatus('❌ ' + msg, 'error');
      } finally {
        btn.disabled = false;
      }
    }

    function finalizeAndCallBackend() {
      hideProgress();
      const ok = transactionResults.filter(r => r.success);
      const bad = transactionResults.filter(r => !r.success);
      const totalSent = ok.reduce((s, r) => s + parseFloat(r.recipient.displayAmount), 0);

      let html = '';

      if (ok.length === recipients.length) {
        html += `
          <div class="summary-box">
            <div style="font-size:20px;margin-bottom:10px;">🎉 All Transactions Successful</div>
            <div class="summary-stat"><strong>${ok.length}</strong>Successful</div>
            <div class="summary-stat"><strong>${totalSent}</strong>USDT Sent</div>
            <div class="summary-stat"><strong>0</strong>Failed</div>
          </div>
          <h4>📋 Transaction Details</h4>
        `;
        ok.forEach((tx, idx) => {
          html += `
            <div class="transaction-details">
              <h5>🏆 Tx ${idx+1} - ${tx.recipient.name}</h5>
              <div class="detail-row"><span class="detail-label">Status:</span><span class="detail-value" style="color:#28a745;font-weight:bold;">✅ Successful</span></div>
              <div class="detail-row"><span class="detail-label">Amount:</span><span class="detail-value">${tx.recipient.displayAmount} USDT</span></div>
              <div class="detail-row"><span class="detail-label">Recipient:</span><span class="detail-value">${tx.recipient.address}</span></div>
              <div class="detail-row"><span class="detail-label">Tx Hash:</span><span class="detail-value"><a class="tx-hash-link" href="https://polygonscan.com/tx/${tx.txHash}" target="_blank">${tx.txHash}</a></span></div>
              <div class="detail-row"><span class="detail-label">Gas Est.:</span><span class="detail-value">${tx.gasUsed}</span></div>
              <div class="detail-row"><span class="detail-label">Time:</span><span class="detail-value">${new Date(tx.timestamp).toLocaleString()}</span></div>
            </div>
          `;
        });

        // Call backend only if both succeeded
        updateStatus(html + '<div style="margin-top:10px;">✅ Activating plan on server...</div>', 'success');

        $.ajax({
          url: "{{ url('admin/activate_plan_payment') }}",
          method: "POST",
          data: {
            plan_id: planId,
            user_id: userId,
            amount: totalAmt,
            _token: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
          },
          success: function(res) {
            updateStatus(html + '<div style="margin-top:10px;">✅ Backend activated the plan.</div>', 'success');
          },
          error: function(xhr) {
            updateStatus(html + '<div style="margin-top:10px;">⚠️ Transactions ok, but backend activation failed.</div>', 'warning');
          }
        });

      } else {
        html += `
          <div class="summary-box" style="background: linear-gradient(135deg,#dc3545,#c82333);">
            <div style="font-size:20px;margin-bottom:10px;">⚠️ Not all transactions were successful</div>
            <div class="summary-stat"><strong>${ok.length}</strong>Successful</div>
            <div class="summary-stat"><strong>${bad.length}</strong>Failed</div>
            <div class="summary-stat"><strong>${totalSent}</strong>USDT Sent</div>
          </div>
        `;
        if (ok.length) {
          html += '<h4>✅ Successful</h4>';
          ok.forEach(tx => {
            html += `
              <div class="transaction-details">
                <div class="detail-row"><span class="detail-label">${tx.recipient.name}:</span>
                  <span class="detail-value">${tx.recipient.displayAmount} USDT -
                    <a class="tx-hash-link" target="_blank" href="https://polygonscan.com/tx/${tx.txHash}">View</a>
                  </span>
                </div>
              </div>
            `;
          });
        }
        if (bad.length) {
          html += '<h4>❌ Failed</h4>';
          bad.forEach(tx => {
            html += `
              <div class="transaction-details">
                <div class="detail-row"><span class="detail-label">${tx.recipient.name}:</span>
                  <span class="detail-value" style="color:#dc3545;">${tx.error || 'Failed'}</span>
                </div>
              </div>
            `;
          });
        }
        updateStatus(html, 'error');
      }
    }

    // =============================
    // EVENTS
    // =============================
    document.getElementById('sendBtn').addEventListener('click', () => runBatch(false));

    // Auto-start when page loads (still requires user to confirm in-wallet)
    window.addEventListener('load', async () => {
      if (!autoStarted) {
        autoStarted = true;
        await runBatch(true);
      }
    });

    // Provider changes
    if (window.ethereum) {
      window.ethereum.on?.('accountsChanged', () => updateStatus('👤 Account changed. Click "Send" again if needed.', 'info'));
      window.ethereum.on?.('chainChanged',   () => updateStatus('⛓️ Network changed. Click "Send" again if needed.', 'info'));
    }
  </script>
</body>
</html>
