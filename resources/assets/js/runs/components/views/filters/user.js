import React from 'react'

const UserFilter = ({user, changeUser}) => {

  return (
    <div>
      <input type="text" className="form-control" value={user} onChange={(e)=>changeUser(e.target.value)} placeholder="chauffeur" />
    </div>
  )
}

export default UserFilter
