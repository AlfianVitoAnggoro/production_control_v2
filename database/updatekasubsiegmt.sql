UPDATE [master_data_man_power]
SET status = 'kasubsie'
WHERE npk = '461' OR npk = '698' OR npk = '639' OR npk = '524' OR npk = '510' OR npk = '2535';

UPDATE [master_data_man_power]
SET status = 'gmt'
WHERE npk LIKE '3010%';

UPDATE [detail_record_master_group_man_power_indirect]
SET nama = '15'
WHERE mesin LIKE 'kasubsie%' AND nama = '1';

UPDATE [detail_record_master_group_man_power_indirect]
SET nama = '79'
WHERE mesin LIKE 'kasubsie%' AND nama = '2';

UPDATE [detail_record_master_group_man_power_indirect]
SET nama = '1'
WHERE mesin LIKE 'kasubsie%' AND nama = '3';

UPDATE [detail_record_master_group_man_power_indirect]
SET nama = '70'
WHERE mesin LIKE 'kasubsie%' AND nama = '4';

UPDATE [detail_record_master_group_man_power_indirect]
SET nama = '67'
WHERE mesin LIKE 'kasubsie%' AND nama = '5';

UPDATE [detail_master_data_group_man_power_indirect]
SET nama = '15'
WHERE mesin LIKE 'kasubsie%' AND nama = '1'

UPDATE [detail_master_data_group_man_power_indirect]
SET nama = '79'
WHERE mesin LIKE 'kasubsie%' AND nama = '2'

UPDATE [detail_master_data_group_man_power_indirect]
SET nama = '1'
WHERE mesin LIKE 'kasubsie%' AND nama = '3'

UPDATE [detail_master_data_group_man_power_indirect]
SET nama = '70'
WHERE mesin LIKE 'kasubsie%' AND nama = '4'

UPDATE [detail_master_data_group_man_power_indirect]
SET nama = '67'
WHERE mesin LIKE 'kasubsie%' AND nama = '5'