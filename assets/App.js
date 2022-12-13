import React, { useState } from "react";
import SearchBox from "./SearchBox";
import Maps from "./Maps";
function App() {
    const [selectPosition, setSelectPosition] = useState(null);
    console.log(selectPosition);
    return (
        <div style={{ display: 'flex', flexDirection: "row", width: "100vw", height: "100vh"}}>
            <div style={{ width: "80vw", height: "100vh"}}>
                <Maps selectPosition={selectPosition}/>
            </div>
            <div style={{ border: "2px solid red", width: "20vw"}}>
                <SearchBox selectPosition={selectPosition} setSelectPosition={setSelectPosition} />
            </div>
        </div>
    );
}

export default App;