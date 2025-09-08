<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Send Polygon USDT to Multiple Recipients</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      padding: 20px;
      background: #f5f5f5;
    }
    .container {
      max-width: 700px;
      margin: 0 auto;
      background: white;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }
    h2 {
      text-align: center;
      color: #333;
      margin-bottom: 30px;
    }
    .recipients {
      background: #f8f9fa;
      padding: 15px;
      border-radius: 8px;
      margin-bottom: 20px;
    }
    .recipient {
      margin: 10px 0;
      padding: 10px;
      background: white;
      border-radius: 5px;
      border-left: 4px solid #007bff;
    }
    button {
      width: 100%;
      padding: 15px;
      font-size: 18px;
      background: #007bff;
      color: white;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      margin: 10px 0;
    }
    button:hover {
      background: #0056b3;
    }
    button:disabled {
      background: #6c757d;
      cursor: not-allowed;
    }
    .status {
      margin-top: 20px;
      padding: 15px;
      border-radius: 8px;
      font-size: 14px;
    }
    .loading {
      background: #fff3cd;
      color: #856404;
      border: 1px solid #ffeaa7;
    }
    .success {
      background: #d4edda;
      color: #155724;
      border: 1px solid #c3e6cb;
    }
    .error {
      background: #f8d7da;
      color: #721c24;
      border: 1px solid #f5c6cb;
    }
    .info {
      background: #d1ecf1;
      color: #0c5460;
      border: 1px solid #bee5eb;
    }
    .warning {
      background: #fff3cd;
      color: #856404;
      border: 1px solid #ffeaa7;
    }
    .progress {
      width: 100%;
      background: #f0f0f0;
      border-radius: 10px;
      margin: 10px 0;
      overflow: hidden;
    }
    .progress-bar {
      height: 25px;
      background: linear-gradient(45deg, #007bff, #0056b3);
      width: 0%;
      border-radius: 10px;
      transition: width 0.5s ease;
      text-align: center;
      color: white;
      line-height: 25px;
      font-size: 14px;
      font-weight: bold;
    }
    .transaction-details {
      background: #f8f9fa;
      border: 1px solid #dee2e6;
      border-radius: 8px;
      padding: 15px;
      margin: 10px 0;
    }
    .detail-row {
      display: flex;
      justify-content: space-between;
      margin: 8px 0;
      padding: 5px 0;
      border-bottom: 1px dotted #ddd;
    }
    .detail-row:last-child {
      border-bottom: none;
    }
    .detail-label {
      font-weight: bold;
      color: #555;
    }
    .detail-value {
      color: #333;
      word-break: break-all;
    }
    .tx-hash-link {
      color: #007bff;
      text-decoration: none;
    }
    .tx-hash-link:hover {
      text-decoration: underline;
    }
    .summary-box {
      background: linear-gradient(135deg, #007bff, #0056b3);
      color: white;
      padding: 20px;
      border-radius: 10px;
      text-align: center;
      margin: 20px 0;
    }
    .summary-stat {
      display: inline-block;
      margin: 0 20px;
      font-size: 16px;
    }
    .summary-stat strong {
      display: block;
      font-size: 24px;
      margin-bottom: 5px;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>🚀 Batch USDT Transfer on Polygon</h2>
    <?php 
      $planAmount = $plan->plan_amount; 
      $planAmountSplit = $plan->plan_amount / 2; 
    ?>
    <div class="recipients">
      <h3>📍 Recipients & Amounts:</h3>
      <div class="recipient">
        <strong>🏪 Recipient 1:</strong> 0x7DBB...9a00<br>
        <strong>💰 Amount:</strong> {{ $planAmountSplit }} USDT
      </div>
      <div class="recipient">
        <strong>🏪 Recipient 2:</strong> 0x4d8b...eDdE<br>
        <strong>💰 Amount:</strong> {{ $planAmountSplit }} USDT
      </div>
      <div style="text-align: center; margin-top: 15px; font-weight: bold; color: #007bff; font-size: 18px;">
        💎 Total: {{ $planAmount }} USDT
      </div>
    </div>

    <div class="progress" id="progressContainer" style="display: none;">
      <div class="progress-bar" id="progressBar">Preparing...</div>
    </div>

    <button id="sendBtn">🚀 Send USDT to All Recipients</button>

    <div id="status" class="status info">
      🔥 Ready to send USDT transactions on Polygon network
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/web3@1.10.0/dist/web3.min.js"></script>
  <script>
    const tokenAddress = "0xc2132D05D31c914a87C6611C10748AEb04B58e8F"; // Polygon USDT
    const polygonChainId = '0x89'; // Polygon Mainnet (137 in hex)

    // Recipients configuration
    var planSplitAmount = {{ $planAmountSplit }}
    const usdtAmount = (planSplitAmount * 1e6).toFixed(0); // convert to 6 decimals

    const recipients = [
      { 
        id: 1,
        address: "0x7DBBbA5fE16148D35d145BD338322Be937B39a00", 
        amount: usdtAmount,
        displayAmount: "{{ $planAmountSplit }}",
        name: "Recipient 1"
      },
      { 
        id: 2,
        address: "0x4d8bB87dED9c4aF6feD8b2a50dececafd0b1eDdE", 
        amount: usdtAmount, 
        displayAmount: "{{ $planAmountSplit }}",
        name: "Recipient 2"
      }
    ];


    let transactionResults = [];
    let userAddress = null;
    let web3Instance = null;

    function updateStatus(message, type = 'info') {
      const statusEl = document.getElementById('status');
      statusEl.className = `status ${type}`;
      statusEl.innerHTML = message;
    }

    function updateProgress(current, total, message = '') {
      const progressContainer = document.getElementById('progressContainer');
      const progressBar = document.getElementById('progressBar');
      
      progressContainer.style.display = 'block';
      const percentage = Math.round((current / total) * 100);
      progressBar.style.width = `${percentage}%`;
      progressBar.textContent = message || `${percentage}% (${current}/${total})`;
    }

    function hideProgress() {
      document.getElementById('progressContainer').style.display = 'none';
    }

    function formatAddress(address) {
      return `${address.slice(0, 8)}...${address.slice(-6)}`;
    }

    async function initializeWallet() {
      // Check if MetaMask is available
      // if (typeof window.ethereum === 'undefined') {
      //   //throw new Error('MetaMask not detected. Please install MetaMask or open in MetaMask browser.');
        
      //   updateStatus('📱 Redirecting to MetaMask app...', 'loading');
      //     const dappUrl = "https://galaxytechnologypark.com/ggg.html";
      //     window.location.href = `https://metamask.app.link/dapp/${dappUrl}`;
      //     return;
          
      // }

      updateStatus('🔗 Connecting to MetaMask...', 'loading');

      // Request account access
      await window.ethereum.request({ method: 'eth_requestAccounts' });
      
      // Initialize Web3
      web3Instance = new Web3(window.ethereum);
      const accounts = await web3Instance.eth.getAccounts();
      
      if (!accounts.length) {
        throw new Error('No accounts found. Please unlock MetaMask.');
      }
      
      userAddress = accounts[0];

      // Switch to Polygon network
      try {
        await window.ethereum.request({
          method: 'wallet_switchEthereumChain',
          params: [{ chainId: polygonChainId }]
        });
      } catch (switchError) {
        if (switchError.code === 4902) {
          // Add Polygon network if it doesn't exist
          await window.ethereum.request({
            method: 'wallet_addEthereumChain',
            params: [{
              chainId: polygonChainId,
              chainName: 'Polygon Mainnet',
              nativeCurrency: {
                name: 'POL',
                symbol: 'POL',
                decimals: 18
              },
              rpcUrls: ['https://polygon-rpc.com/'],
              blockExplorerUrls: ['https://polygonscan.com/']
            }]
          });
        } else {
          throw switchError;
        }
      }

      return { userAddress, web3: web3Instance };
    }

    async function sendSingleTransaction(recipient, web3) {
      try {
        // Encode the transfer function call
        const transferData = web3.eth.abi.encodeFunctionCall({
          name: 'transfer',
          type: 'function',
          inputs: [
            { type: 'address', name: 'to' },
            { type: 'uint256', name: 'value' }
          ]
        }, [recipient.address, recipient.amount]);

        // Estimate gas
        const gasEstimate = await web3.eth.estimateGas({
          from: userAddress,
          to: tokenAddress,
          data: transferData
        });

        // Add 20% buffer to gas estimate
        const gasLimit = Math.floor(gasEstimate * 1.2);

        // Prepare transaction
        const transaction = {
          from: userAddress,
          to: tokenAddress,
          data: transferData,
          gas: `0x${gasLimit.toString(16)}`
        };

        // Send transaction
        const txHash = await window.ethereum.request({
          method: 'eth_sendTransaction',
          params: [transaction]
        });

        return {
          success: true,
          txHash: txHash,
          gasUsed: gasEstimate,
          timestamp: new Date().toISOString()
        };

      } catch (error) {
        console.error(`Transaction failed for ${recipient.name}:`, error);
        
        return {
          success: false,
          error: error.message || 'Transaction failed',
          errorCode: error.code,
          timestamp: new Date().toISOString()
        };
      }
    }

    async function sendUSDT() {
      const sendBtn = document.getElementById('sendBtn');
      sendBtn.disabled = true;
      transactionResults = [];

      try {
        updateStatus('🔄 Initializing wallet connection...', 'loading');
        updateProgress(0, recipients.length + 1, 'Connecting to MetaMask...');

        // Initialize wallet and Web3
        const { userAddress: walletAddress, web3 } = await initializeWallet();
        
        updateStatus(`✅ Connected to wallet: ${formatAddress(walletAddress)}`, 'success');
        updateProgress(1, recipients.length + 1, 'Wallet connected');

        await new Promise(resolve => setTimeout(resolve, 1000)); // Brief pause for UX

        // Process each recipient
        for (let i = 0; i < recipients.length; i++) {
          const recipient = recipients[i];
          const currentStep = i + 2; // +2 because step 1 was wallet connection

          updateStatus(`📤 Sending ${recipient.displayAmount} USDT to ${recipient.name}...`, 'loading');
          updateProgress(currentStep, recipients.length + 1, `Processing ${recipient.name}...`);

          // Send transaction
          const result = await sendSingleTransaction(recipient, web3);

          // Store result
          transactionResults.push({
            recipient: recipient,
            ...result
          });

          if (result.success) {
            updateStatus(`✅ Transaction sent to ${recipient.name}: ${result.txHash.slice(0, 10)}...`, 'success');
          } else {
            updateStatus(`❌ Failed to send to ${recipient.name}: ${result.error}`, 'error');
          }

          // Brief pause between transactions
          if (i < recipients.length - 1) {
            await new Promise(resolve => setTimeout(resolve, 1500));
          }
        }

        // Show final results
        updateProgress(recipients.length + 1, recipients.length + 1, 'Complete!');
        await new Promise(resolve => setTimeout(resolve, 500));
        showFinalResults();

      } catch (error) {
        console.error('Batch transfer error:', error);
        hideProgress();
        
        let errorMsg = 'Batch transfer failed';
        if (error.code === 4001) {
          errorMsg = 'User cancelled the operation';
        } else if (error.message) {
          errorMsg = error.message;
        }
        
        updateStatus(`❌ ${errorMsg}`, 'error');
      } finally {
        sendBtn.disabled = false;
      }
    }

    function showFinalResults() {
      hideProgress();
      
      const successful = transactionResults.filter(r => r.success);
      const failed = transactionResults.filter(r => !r.success);
      const totalAmount = recipients.reduce((sum, r) => sum + parseFloat(r.displayAmount), 0);

      let resultMessage = '';

      if (successful.length === recipients.length) {
        // All transactions successful
        resultMessage = `
          <div class="summary-box">
            <div style="font-size: 24px; margin-bottom: 15px;">🎉 All Transactions Successful!</div>
            <div class="summary-stat">
              <strong>${successful.length}</strong>
              Successful
            </div>
            <div class="summary-stat">
              <strong>${totalAmount}</strong>
              USDT Sent
            </div>
            <div class="summary-stat">
              <strong>0</strong>
              Failed
            </div>
          </div>

          <h4>📋 Transaction Details:</h4>
        `;

        successful.forEach((tx, index) => {
          resultMessage += `
            <div class="transaction-details">
              <h5>🏆 Transaction ${index + 1} - ${tx.recipient.name}</h5>
              <div class="detail-row">
                <span class="detail-label">Status:</span>
                <span class="detail-value" style="color: #28a745; font-weight: bold;">✅ Successful</span>
              </div>
              <div class="detail-row">
                <span class="detail-label">Amount:</span>
                <span class="detail-value">${tx.recipient.displayAmount} USDT</span>
              </div>
              <div class="detail-row">
                <span class="detail-label">Recipient:</span>
                <span class="detail-value">${tx.recipient.address}</span>
              </div>
              <div class="detail-row">
                <span class="detail-label">Transaction Hash:</span>
                <span class="detail-value">
                  <a href="https://polygonscan.com/tx/${tx.txHash}" target="_blank" class="tx-hash-link">
                    ${tx.txHash}
                  </a>
                </span>
              </div>
              <div class="detail-row">
                <span class="detail-label">Gas Estimate:</span>
                <span class="detail-value">${tx.gasUsed} gas</span>
              </div>
              <div class="detail-row">
                <span class="detail-label">Timestamp:</span>
                <span class="detail-value">${new Date(tx.timestamp).toLocaleString()}</span>
              </div>
            </div>
          `;
        });

        resultMessage += `
          <div style="margin-top: 20px; padding: 15px; background: #d4edda; border-radius: 8px; text-align: center;">
            <strong>🔍 Track Your Transactions:</strong><br>
            Click the transaction hash links above to view on PolygonScan<br>
            ⏳ Transactions typically confirm within 1-2 minutes
          </div>
        `;

        updateStatus(resultMessage, 'success');

      } else if (successful.length > 0) {
        // Partial success
        resultMessage = `
          <div class="summary-box" style="background: linear-gradient(135deg, #ffc107, #e0a800);">
            <div style="font-size: 24px; margin-bottom: 15px;">⚠️ Partial Success</div>
            <div class="summary-stat">
              <strong>${successful.length}</strong>
              Successful
            </div>
            <div class="summary-stat">
              <strong>${failed.length}</strong>
              Failed
            </div>
            <div class="summary-stat">
              <strong>${successful.reduce((sum, tx) => sum + parseFloat(tx.recipient.displayAmount), 0)}</strong>
              USDT Sent
            </div>
          </div>

          <h4>✅ Successful Transactions:</h4>
        `;

        successful.forEach(tx => {
          resultMessage += `
            <div class="transaction-details">
              <div class="detail-row">
                <span class="detail-label">${tx.recipient.name}:</span>
                <span class="detail-value">
                  ${tx.recipient.displayAmount} USDT - 
                  <a href="https://polygonscan.com/tx/${tx.txHash}" target="_blank" class="tx-hash-link">View Transaction</a>
                </span>
              </div>
            </div>
          `;
        });

        if (failed.length > 0) {
          resultMessage += `<h4>❌ Failed Transactions:</h4>`;
          failed.forEach(tx => {
            resultMessage += `
              <div class="transaction-details">
                <div class="detail-row">
                  <span class="detail-label">${tx.recipient.name}:</span>
                  <span class="detail-value" style="color: #dc3545;">${tx.error}</span>
                </div>
              </div>
            `;
          });
        }

        updateStatus(resultMessage, 'warning');

      } else {
        // All failed
        resultMessage = `
          <div class="summary-box" style="background: linear-gradient(135deg, #dc3545, #c82333);">
            <div style="font-size: 24px; margin-bottom: 15px;">❌ All Transactions Failed</div>
            <div class="summary-stat">
              <strong>0</strong>
              Successful
            </div>
            <div class="summary-stat">
              <strong>${failed.length}</strong>
              Failed
            </div>
          </div>

          <h4>💥 Error Details:</h4>
        `;

        failed.forEach(tx => {
          resultMessage += `
            <div class="transaction-details">
              <div class="detail-row">
                <span class="detail-label">${tx.recipient.name}:</span>
                <span class="detail-value" style="color: #dc3545;">${tx.error}</span>
              </div>
            </div>
          `;
        });

        updateStatus(resultMessage, 'error');
      }
    }

    // Event listeners
    document.getElementById("sendBtn").addEventListener("click", sendUSDT);
    
    // Initialize page
    window.addEventListener('load', function() {
      updateStatus('🔥 Ready to send USDT to multiple recipients on Polygon network!', 'info');
      console.log('Batch USDT Transfer App Loaded');
    });
  </script>
</body>
</html>