select T_OrderHeaderID, T_OrderHeaderDate, T_OrderHeaderLabNumber, T_OrderHeaderLabNumberExt,
	concat(m_title.M_TitleName,' ', m_patient.M_PatientName)as PasientName,
	m_company.M_CompanyID, m_company.M_CompanyName, T_OrderHeaderTotal,
	GROUP_CONCAT(t_test.T_TestName) as test_name from
	(select t_orderheader.T_OrderHeaderM_PatientID, t_orderheader.T_OrderHeaderM_CompanyID, t_orderheader.T_OrderHeaderID, t_orderheader.T_OrderHeaderDate, t_orderheader.T_OrderHeaderLabNumber, t_orderheader.T_OrderHeaderLabNumberExt, T_OrderHeaderTotal
	from t_orderheader
	where t_orderheader.T_OrderHeaderIsActive = "Y"
	and date(t_orderheader.T_OrderHeaderDate) between StartDate and EndDate
	and  if(CompanyID = 0, t_orderheader.T_OrderHeaderM_CompanyID > 0, t_orderheader.T_OrderHeaderM_CompanyID = CompanyID)) orderheader
	inner join m_patient on orderheader.T_OrderHeaderM_PatientID = m_patient.M_PatientID and m_patient.M_PatientIsActive = "Y"
	left  join m_title on m_patient.M_PatientM_TitleID = m_title.M_TitleID and m_title.M_TitleIsActive = "Y"
	inner join m_company on orderheader.T_OrderHeaderM_CompanyID = m_company.M_CompanyID
	inner join t_orderdetail on orderheader.T_OrderHeaderID = t_orderdetail.T_OrderDetailT_OrderHeaderID and t_orderdetail.T_OrderDetailIsActive = "Y"
	inner join t_test on t_orderdetail.T_OrderDetailT_TestCode = t_test.T_TestCode and t_test.T_TestIsActive = "Y" and t_test.T_TestIsPrice = "Y"
	group by T_OrderHeaderID, T_OrderHeaderDate, T_OrderHeaderLabNumber, T_OrderHeaderLabNumberExt,
	concat(m_title.M_TitleName,' ', m_patient.M_PatientName),
	m_company.M_CompanyID, m_company.M_CompanyName, T_OrderHeaderTotal;
