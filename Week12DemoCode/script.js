let blockchainDiv = document.getElementById("blockchain");
let blocks = [];

function createBlock(index, prevHash = "0"){
    const block = document.createElement("div");
    block.className = "block";

    block.innerHTML = `
    <label>Block #${index}</label><br>
    <input class="data" placeholder="Enter block data"><br>
    <label>Previous Hash:</label>
    <input class="prev-hash" disabled><br>
    <label>Current Hash:</label>
    <input class="curr-hash" readonly><br>
    <button onclick="recalculateChain()">Recalculate Hash</button>
    `;

    blockchainDiv.appendChild(block);
    blocks.push(block);
    block.querySelector(".prev-hash").value = prevHash;
    block.querySelector(".data").addEventListener("input", recalculateChain);

    return block;
}

async function generateHash(content) {
    const encoder = new TextEncoder();
    const data = encoder.encode(content);

    const hashBuffer = await crypto.subtle.digest("SHA-256", data);
    const hashArray = Array.from(new Uint8Array(hashBuffer));
    const hashHex = hashArray.map(b => b.toString(16).padStart(2, "0")).join("");

    return hashHex;

}

async function recalculateChain(){
    let previousHash = "0";

    for(let i = 0; i < blocks.length; i++){
        const block = blocks[i];

        const data = block.querySelector(".data").value;
        const content = data + previousHash;
        const hash = await generateHash(content);

        block.querySelector(".prev-hash").value = previousHash;
        block.querySelector(".curr-hash").value = hash;

        if(i > 0){
            const prevBlock = blocks[i - 1];
            const prevHashCheck = prevBlock.querySelector(".curr-hash").value;

            if(block.querySelector(".prev-hash").value !== prevHashCheck){
                block.classList.add("invalid");
            }else{
                block.classList.remove("invalid");
            }
        }

        previousHash = hash;

    }
}

function addBlock(){
    const index = blocks.length + 1;

    const prevHash = blocks.length
    ? blocks[blocks.length - 1].querySelector(".curr-hash").value
    : "0";

    createBlock(index, prevHash);
    recalculateChain();
}

addBlock();


